<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\MCQ;
use App\Models\Test\Fillup;
use App\Models\Test\Section;
use App\Models\Test\Extract;
use App\Models\Test\Test;
use App\Models\Test\Type;
use App\Models\Test\Attempt;
use App\Models\Product\Product;
use App\Models\Product\Order;
use App\User;

use App\Mail\uploadfile;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Storage;

class AttemptController extends Controller
{
    
    /*
        The Test Attempt Controller
    */

   public function __construct(){
        $this->app      =   'test';
        $this->module   =   'test';
        $this->cache_path   =   '../storage/app/cache/test/';
        $this->cache_path_product   =   '../storage/app/cache/product/';
        if(request()->route('test')){

            // update test from cache
            $filename = $this->cache_path.$this->app.'.'.request()->route('test').'.json'; 
            if(file_exists($filename)){
              $this->test = json_decode(file_get_contents($filename));
            }
            else{
              $this->test = Test::where('slug',request()->route('test'))->first();

              $this->test->sections = $this->test->sections;
              $this->test->mcq_order = $this->test->mcq_order;
              $this->test->fillup_order = $this->test->fillup_order;
              $this->test->testtype = $this->test->testtype;
              $this->test->category = $this->test->category;
              //load test and all the extra data
              $this->test->qcount = 0;
              if(!$this->test->qcount){
                  foreach($this->test->mcq_order as $q){
                        if($q->qno)
                          if($q->qno!=-1)
                          $this->test->qcount++;
                  }
                  foreach($this->test->fillup_order as $q){
                        if($q->qno)
                          if($q->qno!=-1)
                          $this->test->qcount++;
                  }
                
              }
              foreach($this->test->sections as $section){ 
                  $ids = $section->id ;
                  $this->test->sections->$ids = $section->extracts;
                  foreach($this->test->sections->$ids as $m=>$extract){
                      $this->test->sections->$ids->mcq =$extract->mcq_order;
                      $this->test->sections->$ids->fillup=$extract->fillup_order;
                  }
                      
              }

            }

            if(!request()->is('admin/*')){
              //update product from cache
              $product_slug = request()->get('product');
              if(!$product_slug)
                  $this->product = '';
              else{
                $filename = $this->cache_path_product.$product_slug.'.json';
                if(file_exists($filename)){
                  $this->product = json_decode(file_get_contents($filename));
                }else{
                  $this->product = Product::where('slug',$request->get('product'))->first();
                }

              }                  
            }
            
        } 
    }

   

   /* The instructions page for test */
   public function instructions($slug, Request $request){

        if(\auth::user())
        $user = \auth::user();
        else
          $user = null;

        $test = $this->test;
        $product = $this->product;

        $product_id = $test_id = null;

        if($product){
          $id = $product->id;
          $product_id = $id;
          $validity = $product->validity;
          $price = $product->price;
        }
        else{
          $id = $test->id;
          $test_id = $id;
          $validity = $test->validity;
          $price = $test->price;
        }

        //Run prechecks 
        $this->precheck($request);

        /* User Authorization for test */
        $grantaccess = $request->get('grantaccess');
        if($user){
          if(!$user->testAccess($id)){
            if($grantaccess)
            {
              $order = new Order();
              $order->grantaccess($product_id,$test_id,$validity);

            }else{

              if($price==0){
                return view('appl.product.product.freeaccess')
                        ->with('test',$this->test)
                        ->with('product',$this->product);
              }
              else{
                return view('appl.product.product.purchase')
                        ->with('test',$test)
                        ->with('product',$product);
              }
             
            }
          }

          $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->first();

        }else
        {
          if($price!=0){
              return view('appl.product.product.purchase')
                        ->with('test',$test)
                        ->with('product',$product);
          }
          $attempt =null;
        }
        

        

        /* If Attempted show report */
        

        if($attempt){
            $testtype=  strtolower($test->testtype->name);

            if($testtype=='writing' || $testtype == 'speaking')
            {
              if($product)
                return redirect()->route('test.try',['test'=>$this->test->slug,'product'=>$product->slug]);
              else
                return redirect()->route('test.try',['test'=>$this->test->slug]);
            }else{
              if($product)
                return redirect()->route('test.analysis',['test'=>$this->test->slug,'product'=>$product->slug]);
              else
                return redirect()->route('test.analysis',['test'=>$this->test->slug]);
            }
        }else{
            if(!strip_tags($test->instructions)){
              if($product)
                return redirect()->route('test.try',['test'=>$this->test->slug,'product'=>$product->slug]);
              else
                return redirect()->route('test.try',['test'=>$this->test->slug]);

            } 
            else  
              return view('appl.test.attempt.alerts.instructions')
                ->with('test',$test)
                ->with('product',$product)
                ->with('player',true)
                ->with('app',$this);
        }
   }

   /* pre checks for the test */
   public function precheck(Request $request){
    
    $test = $this->test;
    if(!$test)
      abort('403','Test not Found ');
   }

   /* Test Attempt Function */
   public function try($slug,Request $request){
    $test = $this->test;
    $product = $this->product;

    $product_id = $test_id = null;

        if($test){
          $id = $test->id;
          $test_id = $id;
          $price = $test->price;
        }
        else{
          $id = $product->id;
          $product_id = $id;
          $price = $product->price;
        }
    
    if(\auth::user()){
      $user = \auth::user();
      
      if(!$user->testAccess($id)){
         if($price!=0){
                return view('appl.product.product.purchase')
                        ->with('test',$test)
                        ->with('product',$product);
          }
      }
    }
    else{
      if($price!=0){
          return view('appl.product.product.purchase')
                        ->with('test',$test)
                        ->with('product',$product);
          }

      $user = null;
    }

    

    /* Pre validation */
    $this->precheck($request);



    /* If Attempted show report */
    if($user)
    $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->first();
    else
      $attempt = null;

    if($attempt){
      $testtype=  strtolower($test->testtype->name);
      if($testtype=='listening' || $testtype == 'reading')
      {
        if($product)
        return redirect()->route('test.analysis',['test'=>$this->test->slug,'product'=>$product->slug]);
        else
         return redirect()->route('test.analysis',['test'=>$this->test->slug]); 
      }
    }


    (isset($test->qcount))?$qcount = $test->qcount : $qcount=0;

    if(!$test->testtype)
      abort('403','Test Type not defined');
    else
      $view =  strtolower($test->testtype->name);

   if($view == 'listening' || $view == 'grammar' || $view == 'gre')
    return view('appl.test.attempt.try_'.$view)
            ->with('player',true)
            ->with('try',true)
            ->with('gre',true)
            ->with('app',$this)
            ->with('qcount',$qcount)
            ->with('test',$test)
            ->with('product',$product)
            ->with('timer',$user)
            ->with('time',$test->test_time);
   else if($view =='reading'){
    return view('appl.test.attempt.try_'.$view)
        ->with('try',true)
        ->with('app',$this)
        ->with('qcount',$qcount)
        ->with('test',$test)
        ->with('product',$product)
        ->with('reading',1)
        ->with('timer',$user)
        ->with('time',$test->test_time);
    }
   elseif($view =='writing'){
        return view('appl.test.attempt.try_'.$view)
                  ->with('test',$test)
                  ->with('product',$product)
                  ->with('attempt',$attempt)
                  ->with('view',true)
                  ->with('editor',true);
      }
      else{
        return view('appl.test.attempt.try_'.$view)
                  ->with('test',$test)
                  ->with('product',$product)
                  ->with('attempt',$attempt)
                  ->with('view',true)
                  ->with('player',1);
      }

   }


   /* Test View Function - Here you cannot attempt test */
   public function view($slug,Request $request){
      $test = $this->test;

      $user = \auth::user();
      $product = Product::first();
    
      (isset($test->qcount))?$qcount = $test->qcount : $qcount=0;


      if(!$test->testtype)
          abort('403','Test Type not defined');
      else
        $view =  strtolower($test->testtype->name);

       /* If Attempted show report */
      if($user)
      $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->first();
      else
        $attempt = null;

  
      if($view == 'listening' || $view == 'grammar' || $view == 'gre')
        return view('appl.test.attempt.try_'.$view)
                ->with('player',true)
                ->with('try',true)
                ->with('gre',true)
                ->with('app',$this)
                ->with('qcount',$qcount)
                ->with('test',$test)
                ->with('product',$product)
                ->with('view',true)
                ->with('timer',true)
                ->with('time',$test->test_time);
      else if($view =='reading'){
        return view('appl.test.attempt.try_'.$view)
                ->with('try',true)
                ->with('app',$this)
                ->with('qcount',$qcount)
                ->with('test',$test)
                ->with('product',$product)
                ->with('reading',1)
                ->with('view',true)
                ->with('timer',true)
                ->with('time',$test->test_time);
      }
      elseif($view =='writing'){
        return view('appl.test.attempt.try_'.$view)
                  ->with('test',$test)
                  ->with('product',$product)
                  ->with('attempt',$attempt)
                  ->with('view',true)
                  ->with('editor',true);
      }
      else{
        return view('appl.test.attempt.try_'.$view)
                  ->with('test',$test)
                  ->with('product',$product)
                  ->with('app',$this)
                  ->with('attempt',$attempt)
                  ->with('view',true)
                  ->with('player',1);
      }

   }


   /* Function to upload files in server */
   public function upload($slug,Request $request){
      $test = Test::where('slug',$slug)->first();

      $user = \auth::user();
      $type = $request->get('type');
      $product_slug = $request->get('product');
      /* upload the file to server */
      if(isset($request->all()['file_'])){
          $file      = $request->all()['file_'];
          $extension = $file->getClientOriginalExtension();

          /* file type validation */
          if($type=='audio')
          {
            if(!in_array($extension, ['mp3','wav','mkv','mp4','aac','3gp','ogg','mpga']))
              return view('appl.test.attempt.alerts.upload_error')->with('extension',$extension)->with('test',$test);
          }
          
          if($type=='doc')
          {
            if(!in_array($extension, ['doc','docx','rtf','pdf','txt']))
              return view('appl.test.attempt.alerts.upload_error')->with('extension',$extension)->with('test',$test);
          }
          $filename  = $test->slug.'_'.$user->id.'.' . $extension;
          $path = Storage::disk('public')->putFileAs('response', $request->file('file_'), $filename);
      }

      $model = new Attempt();
      $model->user_id = $user->id;
      $model->qno = 1;
      if(!$request->get('response'))
        $model->response = $path;
      else{
        if($request->get('question')){
          $question = summernote_imageupload(\auth::user(),$request->get('question'));
          $question = '<div class="question"><h4>Question</h4>'.$question.'</div><hr>';
          $model->response = $question.'<div class="option response"><h4>Task Response</h4>'.$request->get('response').'</div>';
        }else
          $model->response = '<div class="option response"><h4>Task Response</h4>'.$request->get('response').'</div>';
      }
      $model->test_id = $test->id;


      $model->save();

      //Mail notifaction to the administrator
      if(!$request->get('response'))
      Mail::to(config('mail.report'))->send(new uploadfile($user,$filename));

      flash('Successfully submitted !')->success();
      return redirect()->route($this->module.'.try',['test'=>$this->test->slug,'product'=>$product_slug]);
   }

   /* Delete the File */
   public function file_delete($slug,Request $request){
      $test = Test::where('slug',$slug)->first();
      $user = \auth::user();
      $product_slug = $request->get('product');


      $attempt = Attempt::where('test_id',$test->id)->where('user_id',\auth::user()->id)->first();

      // remove file
      if($attempt){
        if(Storage::disk('public')->exists($attempt->response))
        Storage::disk('public')->delete($attempt->response);
        $attempt->delete();
      }
      

      return redirect()->route($this->module.'.try',['test'=>$this->test->slug,'product'=>$product_slug]);
   }

   /* Function to save data in database */
   public function store($slug,Request $request){
      
      $result = array();
      $score =0;
      $test = $this->test;
      if(!isset($test->product))
      $product = Product::where('slug',$request->get('product'))->first();
      else
      $product = $test->product;

      $user = \auth::user();

      foreach($test->mcq_order as $mcq){
        if($mcq->qno && $mcq->qno!=-1){
          $result[$mcq->qno]['id']=$mcq->id;
          $result[$mcq->qno]['qno']=$mcq->qno;
          $result[$mcq->qno]['type']='mcq';
          $result[$mcq->qno]['answer'] = $mcq->answer;
          $result[$mcq->qno]['response']= '';
          $result[$mcq->qno]['accuracy']= 2;
        }
      }

      foreach($test->fillup_order as $fillup){
          if($fillup->qno && $fillup->qno!=-1){
            $result[$fillup->qno]['id']=$fillup->id;
            $result[$fillup->qno]['qno']=$fillup->qno;
            $result[$fillup->qno]['type']='fillup';
            $result[$fillup->qno]['answer'] = $fillup->answer;
            $result[$fillup->qno]['response']= '';
            $result[$fillup->qno]['accuracy']= 2;
          }
          
      }

      
      foreach($request->except(['test_id','user_id','_token','product','qno','name','email','details','url']) as $qno=>$resp){
        
        $attempt = new Attempt();
        $attempt->test_id = $test->id;
        $attempt->user_id = $user->id;

        if(isset($result[$qno]))
        {
          $attempt->qno = $qno;
          if(is_array($resp))
            $attempt->response = implode(",",$resp);
          else 
            $attempt->response = $resp;
          $attempt->answer = $result[$qno]['answer'];
          if($result[$qno]['type']=='mcq'){
            $attempt->mcq_id = $result[$qno]['id'];
            if($this->matchOptions($result[$qno]['answer'],$resp)){
              $attempt->accuracy =1;
              $result[$qno]['accuracy'] = 1; 
              $score++;
            }elseif($resp == NULL){

            }
            else{
              $attempt->accuracy =0;
              $result[$qno]['accuracy'] = 0; 
            }

          }
          else{
            $attempt->fillup_id = $result[$qno]['id'];

            if($this->compare($result[$qno]['answer'],$resp)){
              $attempt->accuracy =1;
              $result[$qno]['accuracy'] = 1; 
              $score++;
            }elseif($resp == NULL){

            }
            else{
              $attempt->accuracy =0;
              $result[$qno]['accuracy'] = 0; 
            }

          }  
        }

        if(!$request->get('admin'))
          $attempt->save();
      }

      /* for admin submit we wont store the result */
      if($request->get('admin')){

        $band =0;
        $type = strtolower($test->testtype->name);
        if(strtoupper($test->category->name)=='IELTS'){
        if($type=='listening' || $type=='reading'){
          $function_name = $type.'_band';
          $attempt = new Attempt;
          if($test->marks)
          $s = $score * (int)(40/$test->marks);
          else
          $s = $score;
          $band = $attempt->$function_name($s);

          }
        }

        ksort($result);

         return view('appl.test.attempt.alerts.result')
              ->with('result',$result)
              ->with('test',$test)
              ->with('band',$band)
              ->with('admin',1)
              ->with('score',$score);
      }

      if($product)
      return redirect()->route($this->module.'.analysis',['test'=>$this->test->slug,'product'=>$product->slug]);
      else
      return redirect()->route($this->module.'.analysis',['test'=>$this->test->slug]); 
   }

   /* Function to compare the answer with response */
   public function compare($answer,$response){
      $match = false;
      $pieces = explode("/",$answer);
      foreach($pieces as $p){
        $p = strtoupper(str_replace(' ', '', $p));
        $response = strtoupper(str_replace(' ', '', $response));
        if($p == $response)
          $match = true;
      }
      return $match;
   }

   /* Function to compare the answer with response */
   public function matchOptions($answer,$response){
      $answers = explode(",",$answer);
      /* multi answer if response is array */
      if(is_array($response)){

        if(count($answers) == count($response)){
          foreach($response as $resp){
            if(strpos($answer, $resp) !== FALSE){
              
            }else{
                return false;
            }
          }
          return true;
        }
        
      }else{
        $answer = strtoupper(str_replace(' ', '', $answer));
        $response = strtoupper(str_replace(' ', '', $response));
        if($answer==$response)
          return true;
      }
      return false;
   }

   

   /* Function to display the analysis of the test */
   public function analysis($slug,Request $request){
      $test = Test::where('slug',$slug)->first();
      $user = \auth::user();
      $result = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->get();

      $score = 0;
      foreach($result as $r){
        if($r->accuracy==1)
          $score++;
      }

      $band =0;
      $type = strtolower($test->testtype->name);
      if(strtoupper($test->category->name)=='IELTS'){
      if($type=='listening' || $type=='reading'){
        $function_name = $type.'_band';
        $attempt = new Attempt;
        if($test->marks)
          $s = $score * (int)(40/$test->marks);
        else
          $s = $score;
        $band = $attempt->$function_name($s);
      }
      }
      
      return view('appl.test.attempt.alerts.result')
              ->with('result',$result)
              ->with('test',$test)
              ->with('band',$band)
              ->with('score',$score);
   }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function review($slug,Request $request)
    {
        if($request->get('user_id'))
          $user_id = $request->get('user_id');
        else
          $user_id = \auth::user()->id;

        $test = Test::where('slug',$slug)->first();
        $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user_id)->first();

        $user = User::find($user_id);

        
        if($attempt)
        if($attempt->answer || Storage::disk('public')->exists('feedback/feedback_'.$attempt->id.'.pdf'))
            return view('appl.'.$this->app.'.attempt.alerts.review')
                    ->with('attempt',$attempt)
                    ->with('test',$test)
                    ->with('user',$user);
        else
            abort(403,'No Review Found');
        else
          abort(403,'Test not attempted');
    }
}

