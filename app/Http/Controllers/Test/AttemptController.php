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
          $price = $test->price;

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

    $pte = 0;
    if(!$test->testtype)
      abort('403','Test Type not defined');
    else{
      $testtype = strtolower($test->testtype->name);
      if($test->category->name=='PTE' && ($testtype=='listening' || $testtype=='reading')){
        $view =  'pte_'.strtolower($test->testtype->name);
        $pte=1;
      }
      else
      $view = strtolower($test->testtype->name);

      // limit writing submissions to 2 in 24 hours
      if($testtype == 'writing'){
        //$type = Type::where('name','writing')->first();
        
        $test_ids = Test::where('type_id',3)->get()->pluck('id');
        $wattempt = Attempt::whereIn('test_id',$test_ids)->where('user_id',$user->id)->orderBy('created_at','desc')->limit(2)->get();

        $wcount =0;
        $today =  \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
        foreach($wattempt as $k=>$w){
          $createdDate = \Carbon\Carbon::parse($w->created_at);
          $hr = $today->diffInHours($createdDate);
          $wattempt[$k]->time_diff = $hr;
          if($hr<24){
            $wcount++;
          }
        }
        //dd($today);
       // dd($wattempt);

        if($wcount==2 && !$attempt){
            return view('appl.test.attempt.alerts.writing_limit')
                        ->with('test',$test)
                        ->with('wattempt',$wattempt);
        }
        
      }

    }



   if($view == 'listening' || $view == 'grammar' || $view =='english')
    return view('appl.test.attempt.try_'.$view)
            ->with('player',true)
            ->with('try',true)
            ->with('grammar',true)
            ->with('app',$this)
            ->with('qcount',$qcount)
            ->with('pte',$pte)
            ->with('test',$test)
            ->with('product',$product)
            ->with('timer',$user)
            ->with('time',$test->test_time);
    else if($view == 'gre')
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
        ->with('pte',$pte)
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
                  ->with('pte',$pte)
                  ->with('timer',$user)
                  ->with('time',$test->test_time)
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


      $pte = 0  ;
      if(!$test->testtype)
        abort('403','Test Type not defined');
      else{
        $testtype = strtolower($test->testtype->name);
        if($test->category->name=='PTE' && ($testtype=='listening' || $testtype=='reading')){
            $view =  'pte_'.strtolower($test->testtype->name);
            $pte = 1;
        }
        
        else
        $view = strtolower($test->testtype->name);
      }


       /* If Attempted show report */
      if($user)
      $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->first();
      else
        $attempt = null;

  
    if($view == 'listening' || $view == 'grammar' || $view =='english' )
    return view('appl.test.attempt.try_'.$view)
            ->with('player',true)
            ->with('try',true)
            ->with('grammar',true)
            ->with('app',$this)
            ->with('qcount',$qcount)
            ->with('test',$test)
            ->with('pte',$pte)
            ->with('product',$product)
            ->with('timer',$user)
            ->with('view',true)
            ->with('time',$test->test_time);
    else if($view == 'gre'){
      
      return view('appl.test.attempt.try_'.$view)
            ->with('player',true)
            ->with('try',true)
            ->with('gre',true)
            ->with('app',$this)
            ->with('qcount',$qcount)
            ->with('test',$test)
            ->with('product',$product)
            ->with('timer',$user)
            ->with('view',true)
            ->with('time',$test->test_time);
    }
    
      else if($view =='reading'){

        return view('appl.test.attempt.try_'.$view)
                ->with('try',true)
                ->with('app',$this)
                ->with('qcount',$qcount)
                ->with('test',$test)
                ->with('pte',$pte)
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
                  ->with('pte',$pte)
                  ->with('attempt',$attempt)
                  ->with('timer',$user)
                  ->with('time',$test->test_time)
                  ->with('view',true)
                  ->with('player',1);
      }

   }


   /* Function to upload files in server */
   public function upload($slug,Request $request){
      $test = Test::where('slug',$slug)->first();

      if($request->get('accept')&& !$request->get('response'))
      {
        flash('Response cannot be empty!')->error();
        return redirect()->back()->withInput();
      }
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

      $exists = Attempt::where('test_id',$test->id)->where('user_id',\auth::user()->id)->first();
      if($exists){
          return redirect()->route($this->module.'.try',['test'=>$this->test->slug,'product'=>$product_slug]);
      }

      $model = new Attempt();
      $model->user_id = $user->id;
      $model->qno = 1;
      if(!$request->get('response'))

        $model->response = $path;
      else{
        if($request->get('question')){
          $question = summernote_imageupload(\auth::user(),$request->get('question'));
          $question = '<div class="question"><p><h4>Question</h4></p>'.$question.'</div><hr>';
          $model->response = $question.'<div class="option response"><p><h4>Task Response</h4></p>'.$request->get('response').'</div>';
        }else
          $model->response = '<div class="option response"><p><h4>Task Response</h4></p>'.$request->get('response').'</div>';
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

      $attempt = Attempt::where('test_id',$this->test->id)->where('user_id',$user->id)->first();
      if($attempt){
        if($product)
      return redirect()->route($this->module.'.analysis',['test'=>$this->test->slug,'product'=>$product->slug]);
      else
      return redirect()->route($this->module.'.analysis',['test'=>$this->test->slug]); 
      }


      foreach($test->mcq_order as $mcq){
        if($mcq->qno && $mcq->qno!=-1){
          $result[$mcq->qno]['id']=$mcq->id;
          $result[$mcq->qno]['mcq_id']=$mcq->id;
          $result[$mcq->qno]['fillup_id']=null;
          $result[$mcq->qno]['qno']=$mcq->qno;
          $result[$mcq->qno]['type']='mcq';
          $result[$mcq->qno]['answer'] = $mcq->answer;
          $result[$mcq->qno]['response']= '';
          $result[$mcq->qno]['accuracy']= 0;
        }
        // GRE numeric and fraction answer
        if(!strip_tags($mcq->answer)){

          if($mcq->a && !strip_tags($mcq->b) && !strip_tags($mcq->c)){
            $result[$mcq->qno]['answer'] = trim(strip_tags($mcq->a));
          }else if($mcq->a && strip_tags($mcq->b) && !strip_tags($mcq->c)){
            $result[$mcq->qno]['answer'] = trim(strip_tags($mcq->a)).'/'.trim(strip_tags($mcq->b));
          }
        }
      }

      foreach($test->fillup_order as $fillup){
          if($fillup->qno && $fillup->qno!=-1){
            $result[$fillup->qno]['id']=$fillup->id;
            $result[$fillup->qno]['mcq_id']=null;
            $result[$fillup->qno]['fillup_id']=$fillup->id;
            $result[$fillup->qno]['qno']=$fillup->qno;
            $result[$fillup->qno]['type']='fillup';
            $result[$fillup->qno]['answer'] = $fillup->answer;
            $result[$fillup->qno]['response']= '';
            $result[$fillup->qno]['accuracy']= 0;
            $result[$fillup->qno]['two_blanks'] =0;
          }
          
        if($fillup->layout=='ielts_two_blank'){
            $fillup->answer= str_replace('[', '&[', $fillup->answer);
            $new_ans = delete_all_between('[',']',$fillup->answer);
            $result[$fillup->qno]['answer'] = $new_ans;
            $result[$fillup->qno]['two_blanks'] =1;
        }

        if($fillup->layout=='pte_reorder'){
          $result[$fillup->qno]['pte_reorder'] =1;
        }
      }

      
      ksort($result);

      
      $data = array();
      $date_time = new \DateTime();
      $i=0;
      foreach($result as $res){
        if(isset($res['qno'])){
        $qno = $res['qno'];
        $data[$i]['test_id'] = $this->test->id;
        $data[$i]['user_id'] = $user->id;
        $data[$i]['mcq_id'] = $res['mcq_id'];
        $data[$i]['fillup_id'] = $res['fillup_id'];
        $data[$i]['qno'] = $res['qno'];
        $data[$i]['created_at'] = $date_time;
        $data[$i]['updated_at'] = $date_time;
        $data[$i]['answer'] =$res['answer'];
        $data[$i]['response'] = null;
        $data[$i]['accuracy'] =$res['accuracy'];

        


        $resp = $request->get($qno);
        if($resp){

          if(is_array($resp))
            $data[$i]['response']  = implode(",",$resp);
          else 
            $data[$i]['response']  = $resp;

          if($res['mcq_id']){
            if($this->matchOptions($res['answer'],$resp)){
              $data[$i]['accuracy'] =1;
              $result[$qno]['accuracy'] = 1; 
              $score++;
            }elseif($resp == NULL){

            }
            else{
              $data[$i]['accuracy'] =0;
              $result[$qno]['accuracy'] = 0; 
            }

          }else{

            $data[$i]['accuracy'] = 0;
            $result[$qno]['accuracy'] = 0; 

            if($res['two_blanks']){

              if($this->matchAnswers($res['answer'],$resp)){
                $data[$i]['accuracy'] =1;
                $result[$qno]['accuracy'] = 1; 
                $score++;
              }

            }else if(isset($res['pte_reorder'])){

              $qscore = $this->matchReorder($res['answer'],$resp);

              $data[$i]['accuracy'] =$qscore;
              $result[$qno]['accuracy'] = $qscore;
              $score = $score+$qscore;

            }
            else{

              if($this->compare($res['answer'],$resp)){
                $data[$i]['accuracy'] =1;
                $result[$qno]['accuracy'] = 1; 
                $score++;
              }

            }
            
          }
        
        }
        
        
        $i++;
        }
      }

      $this->section_score($data);
      if(!$request->get('admin'))
        Attempt::insert($data); 
      

      
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

        /* sectional score */
        $section_score = $this->section_score($result);


        $tags = Attempt::tags($data);
        $secs = $this->graph($tags);
        

         return view('appl.test.attempt.alerts.result')
              ->with('result',$result)
              ->with('section_score',$section_score)
              ->with('test',$test)
              ->with('band',$band)
              ->with('tags',$tags)
              ->with('secs',$secs)
              ->with('admin',1)
              ->with('score',$score);
      }

      

      if($product)
      return redirect()->route($this->module.'.analysis',['test'=>$this->test->slug,'product'=>$product->slug]);
      else
      return redirect()->route($this->module.'.analysis',['test'=>$this->test->slug]); 
   }

   /* calculate section score */
   public function section_score($data){
      $test = $this->test;
      $result =array();
      $sec = null;
      if(isset($test->sections)){
          foreach($test->sections as $section){

            foreach($section->mcq_order as $mcq_order){

                $result[$mcq_order->qno] = $section->id;
                $result_name[$mcq_order->qno] = $section->name;
            }
            foreach($section->fillup_order as $fillup_order){
              $result[$fillup_order->qno] = $section->id;
              $result_name[$fillup_order->qno] = $section->name;
            }
        }

        foreach($data as $item){
            
            if(isset($item->qno)){
              $qno = $item->qno;
              $accuracy = $item->accuracy;
              $answer = $item->answer;
            }
            else{
              if(!isset($item['qno']))
                continue;
              $qno = $item['qno'];
              $accuracy = $item['accuracy'];
              $answer = $item['answer'];
            }

            if(isset($result_name[$qno]))
              $sec_name = $result_name[$qno];
            else
              $sec_name = '';

            if(!isset($sec[$sec_name]['score']))
              $sec[$sec_name]['score'] =0;

            $sec[$sec_name]['questions'][$qno] = new Attempt();
            $sec[$sec_name]['questions'][$qno]->answer = $answer;
            $sec[$sec_name]['questions'][$qno]->accuracy = $accuracy;
            if($accuracy==1)
              $sec[$sec_name]['score']++;
        }
      }
      

      return $sec;
      
   }

   /* Function to compare the answer with response */
   public function compare($answer,$response){
      $match = false;
      $pieces = explode("/",$answer);
      foreach($pieces as $p){
        $p = strtoupper(str_replace(' ', '', $p));
        if(!is_array($response))
        $response = strtoupper(str_replace(' ', '', $response));
        if($p == $response)
          $match = true;
      }
      return $match;
   }

   public function matchReorder($answer,$response){
      $answer = strtoupper(str_replace(' ', '', $answer));
      $response = strtoupper(str_replace(' ', '', $response));
      
      $ans_bits = explode(',',$answer);
      $ans_pairs = [];

      foreach($ans_bits as $k=>$ans){
        if(isset($ans_bits[$k+1]))
          $ans_pairs[$k] = $ans_bits[$k].','.$ans_bits[$k+1];
      }



      $count =0;
      foreach($ans_pairs as $ans_item){
        if(strpos($response, $ans_item) !== FALSE){
           $count++;   
        }else{
            
        }
      }
      
      return $count;

   }

   public function matchAnswers($answer,$response){
      $answer = strtoupper(str_replace(' ', '', $answer));
      if(strpos($answer, ',') !== false)
        $answers = explode(",",$answer);
      else if(strpos($answer, '/') !== false)
        $answers = explode("/",$answer);
      else if(strpos($answer, '&') !== false)
        $answers = explode("&",$answer);

      /* pre check */
      if(is_array($answers) && is_array($response)){
        $same_answer = false;
        if(count(array_unique($answers)) === 1){
          $same_answer = end($answers);
        }

        $same_response = false;
        if(count(array_unique($response)) === 1){
          $same_response = strtoupper(end($response));
        }

        if($same_answer){
          if($same_answer == $same_response)
            return true;
          else
            return false;
        }else{
          if($same_response)
            return false;
        }

      }
      

      
      
      $pieces = explode("/",$answer);
      if(is_array($response)){

        if(count($answers) == count($response)){
          foreach($response as $resp){
            $resp = strtoupper(str_replace(' ', '', $resp));
            if($resp=='')
              return false;
            if(is_int($resp))
            {

            }else{
                if(strpos($answer, $resp) !== FALSE){
              
                }else{
                    return false;
                }
            }
            
          }
          return true;
        }else
          return false;
        
      }else{
        foreach($pieces as $p){
        $p = trim(strtoupper(str_replace(' ', '', $p)));
        $response = trim(strtoupper(str_replace(' ', '', $response)));
        if($p == $response)
          return true;
        }
      }
      return false;

   }

   /* Function to compare the answer with response */
   public function matchOptions($answer,$response){
      if(strpos($answer, ',') !== false)
        $answers = explode(",",$answer);
      else if(strpos($answer, '/') !== false)
        $answers = explode("/",$answer);
      /* multi answer if response is array */
      if(is_array($response)){
        
        if(strpos($answer, '/') !== false){
            $res = implode("/",$response);
            if($res == $answer)
              return true;
        }
        else if(count($answers) == count($response)){
          foreach($response as $resp){
            if(is_int($resp))
            {

            }else{
                if(strpos($answer, $resp) !== FALSE){
              
                }else{
                    return false;
                }
            }
            
          }
          return true;
        }
        
      }else{
        $answer = trim(strtoupper(str_replace(' ', '', $answer)));
        $response = trim(strtoupper(str_replace(' ', '', $response)));
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

     $tags = Attempt::tags($result);
     $secs = $this->graph($tags);

     //dd($secs);
      /* sectional score */
     $section_score = $this->section_score($result);
      
      
      
      return view('appl.test.attempt.alerts.result')
              ->with('result',$result)
              ->with('section_score',$section_score)
              ->with('test',$test)
              ->with('band',$band)
              ->with('tags',$tags)
              ->with('secs',$secs)
              ->with('score',$score);
   }

   public function graph($tags){
        $green = "rgba(60, 120, 40, 0.8)";
        $red = "rgba(219, 55, 50, 0.9)";
        $yellow = "rgba(255, 206, 86, 0.9)";
        $blue ="rgba(60, 108, 208, 0.8)";

        $num =['one','two','three','four','five'];
        $k=1;
        foreach($tags as $name =>$tag){
          $i=0;
          $section = new Attempt;
          $section->section_id = $k++;
          
          $labels =[];
          $section->suggestion ='';
           $section->average = 50;
          
          foreach($tag as $im=>$t){
            $number = $num[$i];
            $number_color = $number.'_color';
            $section->$number = $t['percent'];
            if($t['percent']>80)
              $section->$number_color = $green;
            else if($t['percent']>60 && $t['percent']<81)
              $section->$number_color = $blue;
            else if($t['percent']>40 && $t['percent']<61)
              $section->$number_color = $yellow;
            else
              $section->$number_color = $red;

            $labels[$i]= $im;
            $i++;
          }
          $section->labels = $labels;
          $secs[$name] = $section;
        }

        if(isset($secs))
        return $secs;
        else
        return null;

         
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

