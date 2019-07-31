<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\MCQ;
use App\Models\Test\Fillup;
use App\Models\Test\Section;
use App\Models\Test\Extract;
use App\Models\Test\Test;
use App\Models\Test\Attempt;
use App\Models\Product\Product;
use App\Models\Product\Order;

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
        if(request()->route('test')){
            $this->test = Test::where('slug',request()->route('test'))->first();
        } 
    }

   /* The default function for test */
   public function instructions($slug, Request $request){
        $test = Test::where('slug',$slug)->first();
        if(!$test)
            abort('403','Test not Found ');

        $user = \auth::user();
        $product = Product::where('slug',$request->get('product'))->first();
        $grantaccess = $request->get('grantaccess');

        if(!$product)
          abort('403','Product Not Defined');
        if(!$test->group->products->find($product->id))
          abort('403','Test is not a part of product');

        /* Authorization */
        if(!$user->productAccess($product)){
          if($grantaccess)
          {
            $order = new Order();
            $order->grantaccess($product->id);

          }else{
            if($product->price==0)
              return view('appl.product.product.freeaccess')
                  ->with('test',$test)
                  ->with('product',$product);
            else
              return view('appl.product.product.purchase')
                  ->with('test',$test)
                  ->with('product',$product);
          }
         
        }

        /* If Attempted show report */
        $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->first();

        if($attempt){
            $testtype=  strtolower($test->testtype->name);

            if($testtype=='writing' || $testtype == 'speaking')
            {
              return redirect()->route('test.try',['test'=>$this->test->slug,'product'=>$product->slug]);
            }else{
              return redirect()->route('test.analysis',['test'=>$this->test->slug,'product'=>$product->slug]);
            }
        }else{
            return view('appl.test.attempt.instructions')
                ->with('test',$test)
                ->with('product',$product)
                ->with('player',true)
                ->with('app',$this);
        }
        

        
        

   }

   /* Test Attempt Function */
   public function try($slug,Request $request){
      $test = Test::where('slug',$slug)->first();

        $user = \auth::user();
        $product = Product::where('slug',$request->get('product'))->first();
        
        if(!$product)
          abort('403','Product Not Defined');
        if(!$test->group->products->find($product->id))
          abort('403','Test is not a part of product');

        /* Authorization */
        if(!$user->productAccess($product))
          return view('appl.product.product.purchase')
                  ->with('test',$test)
                  ->with('product',$product);

      /* If Attempted show report */
        $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->first();

        if($attempt){
            $testtype=  strtolower($test->testtype->name);

            if($testtype=='listening' || $testtype == 'reading')
            {
              return redirect()->route('test.analysis',['test'=>$this->test->slug,'product'=>$product->slug]);
            }
        }

      $qcount = 0;

      if(!$test->testtype)
          abort('403','Test Type not defined');
      else
        $view =  strtolower($test->testtype->name);

      foreach($test->sections as $section){
        foreach($section->extracts as $extract){
          foreach($extract->mcq as $mcq){
            if($mcq->qno)
              $qcount++;
          }
          foreach($extract->fillup as $fillup){
            if($fillup->qno)
             $qcount++;
          }
        }
      }

      
      if($view == 'listening')
        return view('appl.test.attempt.try_'.$view)
                ->with('player',true)
                ->with('try',true)
                ->with('app',$this)
                ->with('qcount',$qcount)
                ->with('test',$test)
                ->with('product',$product)
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
                ->with('timer',true)
                ->with('time',$test->test_time);
      }
      else{
        $attempt = Attempt::where('test_id',$test->id)->where('user_id',\auth::user()->id)->first();
        return view('appl.test.attempt.try_'.$view)
                  ->with('test',$test)
                  ->with('product',$product)
                  ->with('attempt',$attempt)
                  ->with('player',1);
      }

   }


   /* Test View Function - Here you cannot attempt test */
   public function view($slug,Request $request){
      $test = Test::where('slug',$slug)->first();

      $user = \auth::user();
      $product = Product::first();
    

      $qcount = 0;

      if(!$test->testtype)
          abort('403','Test Type not defined');
      else
        $view =  strtolower($test->testtype->name);

      foreach($test->sections as $section){
        foreach($section->extracts as $extract){
          foreach($extract->mcq as $mcq){
            if($mcq->qno)
              $qcount++;
          }
          foreach($extract->fillup as $fillup){
            if($fillup->qno)
             $qcount++;
          }
        }
      }

      
      if($view == 'listening')
        return view('appl.test.attempt.try_'.$view)
                ->with('player',true)
                ->with('try',true)
                ->with('app',$this)
                ->with('qcount',$qcount)
                ->with('test',$test)
                ->with('product',$product)
                ->with('view',true)
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
                ->with('time',$test->test_time);
      }
      else{
        $attempt = Attempt::where('test_id',$test->id)->where('user_id',\auth::user()->id)->first();
        return view('appl.test.attempt.try_'.$view)
                  ->with('test',$test)
                  ->with('product',$product)
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
      $product_slug = $request->get('product_slug');
      /* upload the file to server */
      if(isset($request->all()['file_'])){
          $file      = $request->all()['file_'];
          $extension = $file->getClientOriginalExtension();

          /* file type validation */
          if($type=='audio')
          {
            if(!in_array($extension, ['mp3','wav','mkv']))
              return view('appl.test.attempt.upload_error')->with('extension',$extension);
          }
          
          if($type=='doc')
          {
            if(!in_array($extension, ['doc','docx','rtf','pdf','txt']))
              return view('appl.test.attempt.upload_error')->with('extension',$extension);
          }
          $filename  = $test->slug.'_'.$user->id.'.' . $extension;
          $path = Storage::disk('uploads')->putFileAs('response', $request->file('file_'), $filename);
      }

      $model = new Attempt();
      $model->user_id = $user->id;
      $model->qno = 1;
      $model->response = $path;
      $model->test_id = $test->id;
      $model->save();

      //Mail notifaction to the administrator
      Mail::to(config('mail.report'))->send(new uploadfile($user,$filename));

      flash('Successfully uploaded the file !')->success();
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
        if(Storage::disk('uploads')->exists($attempt->response))
        Storage::disk('uploads')->delete($attempt->response);
        $attempt->delete();
      }
      

      return redirect()->route($this->module.'.try',['test'=>$this->test->slug,'product'=>$product_slug]);
   }

   /* Function to save data in database */
   public function store($slug,Request $request){
      
      $result = array();
      $score =0;
      $test = Test::where('slug',$slug)->first();
      $product = Product::where('slug',$request->get('product'))->first();
      $user = \auth::user();
      foreach($test->sections as $section){
        foreach($section->extracts as $extract){
          foreach($extract->mcq as $mcq){
              $result[$mcq->qno]['id']=$mcq->id;
              $result[$mcq->qno]['type']='mcq';
              $result[$mcq->qno]['answer'] = $mcq->answer;
              $result[$mcq->qno]['response']= '';
              $result[$mcq->qno]['accuracy']= 2;
              if($mcq->qno){
                $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->where('qno',$mcq->qno)->first();
                if(!$attempt)
                  Attempt::create(['test_id'=>$test->id,'user_id'=>$user->id,'mcq_id'=>$mcq->id,'qno'=>$mcq->qno,'answer'=>$mcq->answer,'response'=>'','accuracy'=>2]);
              }
              
          }
          foreach($extract->fillup as $fillup){
             $result[$fillup->qno]['id']=$fillup->id;
             $result[$fillup->qno]['type']='fillup';
             $result[$fillup->qno]['answer'] = $fillup->answer;
             $result[$fillup->qno]['response']= '';
             $result[$fillup->qno]['accuracy']= 2;
             if($fillup->qno){
                $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->where('qno',$fillup->qno)->first();
                if(!$attempt)
                   Attempt::create(['test_id'=>$test->id,'user_id'=>$user->id,'fillup_id'=>$fillup->id,'qno'=>$fillup->qno,'answer'=>$fillup->answer,'response'=>'','accuracy'=>2]);
             }
             
          }
          
        }
      }

      foreach($request->except(['test_id','user_id','_token','product']) as $qno=>$resp){

        $attempt = Attempt::where('test_id',$test->id)->where('user_id',$user->id)->where('qno',$qno)->first();
        if(!$attempt)
          $attempt = new Attempt();

        $attempt->test_id = $test->id;
        $attempt->user_id = $user->id;

        if(isset($result[$qno]))
        {
          $attempt->qno = $qno;
          if($result[$qno]['type']=='mcq')
          $attempt->mcq_id = $result[$qno]['id'];
          else
          $attempt->fillup_id = $result[$qno]['id'];

          $result[$qno]['response'] = $resp;
          $attempt->response = $resp;
          $attempt->answer = $result[$qno]['answer'];
          if($this->compare($result[$qno]['answer'],$resp)){
            $attempt->accuracy =1;
            $score++;
            $result[$qno]['accuracy'] = 1;
          }elseif($resp == NULL){

          }
          else{
            $attempt->accuracy =0;
            $result[$qno]['accuracy'] = 0;
          }
             

        }
        $attempt->save();

      }
      return redirect()->route($this->module.'.analysis',['test'=>$this->test->slug,'product'=>$product->slug]);
   }

   /* Function to compare the answer with response */
   public function compare($answer,$response){
      $match = false;
      $pieces = explode("/",$answer);
      foreach($pieces as $p){
        $p = strtoupper(str_replace(' ', '', $p));
        $response = strtoupper(str_replace(' ', '', $response));
        //echo $p.' '.$response."<br>";
        if($p == $response)
          $match = true;
      }
      return $match;
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

      return view('appl.test.attempt.result')
              ->with('result',$result)
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
        $test = Test::where('slug',$slug)->first();
        $attempt = Attempt::where('test_id',$test->id)->where('user_id',\auth::user()->id)->first();

        if($attempt)
        if($attempt->answer)
            return view('appl.'.$this->app.'.attempt.review')
                    ->with('attempt',$attempt)->with('test',$test);
        else
            abort(403,'No Review Found');
        else
          abort(403,'Test not attempted');
    }
}







