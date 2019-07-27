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
        if($test)
        return view('appl.test.attempt.instructions')
                ->with('test',$test)
                ->with('player',true)
                ->with('app',$this);
        else
            abort('403','Test not Found ');

   }

   /* Test Attempt Function */
   public function try($slug,Request $request){
      $test = Test::where('slug',$slug)->first();

      $qcount = 0;

      if(!$test->testtype)
          abort('403','Test Type not defined');
      else
        $view =  strtolower($test->testtype->first()->name);

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

      if($view == 'listening' || $view == 'reading')
        return view('appl.test.attempt.try_'.$view)
                ->with('player',true)
                ->with('try',true)
                ->with('app',$this)
                ->with('qcount',$qcount)
                ->with('test',$test)
                ->with('timer',true)
                ->with('time',$test->test_time);
      else{
        $attempt = Attempt::where('test_id',$test->id)->where('user_id',\auth::user()->id)->first();
        return view('appl.test.attempt.try_'.$view)
                  ->with('test',$test)
                  ->with('attempt',$attempt)
                  ->with('player',1);
      }

   }

   /* Function to upload files in server */
   public function upload($slug,Request $request){
      $test = Test::where('slug',$slug)->first();
      $user = \auth::user();
      /* upload the file to server */
      if(isset($request->all()['file_'])){
          $file      = $request->all()['file_'];
          $extension = $file->getClientOriginalExtension();
          $filename  = $test->slug.'_'.$user->id.'.' . $extension;
          $path = Storage::disk('uploads')->putFileAs('response', $request->file('file_'), $filename);
      }

      $model = new Attempt();
      $model->user_id = $user->id;
      $model->qno = 1;
      $model->response = $path;
      $model->test_id = $test->id;
      $model->save();

      flash('Successfully uploaded the file !')->success();
      return redirect()->route($this->module.'.try',[$this->test->slug]);
   }

   /* Delete the File */
   public function file_delete($slug,Request $request){
      $test = Test::where('slug',$slug)->first();
      $user = \auth::user();

      $attempt = Attempt::where('test_id',$test->id)->where('user_id',\auth::user()->id)->first();

      // remove file
      if($attempt){
        if(Storage::disk('uploads')->exists($attempt->response))
        Storage::disk('uploads')->delete($attempt->response);
        $attempt->delete();
      }
      

      return redirect()->route($this->module.'.try',[$this->test->slug]);
   }

   /* Function to save data in database */
   public function store($slug,Request $request){
      $result = array();
      $score =0;
      $test = Test::where('slug',$slug)->first();
      foreach($test->sections as $section){
        foreach($section->extracts as $extract){
          foreach($extract->mcq as $mcq){
              $result[$mcq->qno]['answer'] = $mcq->answer;
              $result[$mcq->qno]['response']= '';
          $result[$mcq->qno]['accuracy']= 2;
          }
          foreach($extract->fillup as $fillup){
             $result[$fillup->qno]['answer'] = $fillup->answer;
             $result[$fillup->qno]['response']= '';
             $result[$fillup->qno]['accuracy']= 2;
          }
          
        }
      }
      foreach($request->all() as $qno=>$resp){
        if(isset($result[$qno]))
        {
          $result[$qno]['response'] = $resp;
          if($this->compare($result[$qno]['answer'],$resp)){
            $score++;
            $result[$qno]['accuracy'] = 1;
          }
          else
             $result[$qno]['accuracy'] = 0;

        }
      }
      return view('appl.test.attempt.result')->with('result',$result)->with('score',$score);
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
      $result = array();
      $test = Test::where('slug',$slug)->first();
      foreach($test->sections as $section){
        foreach($section->extracts as $extract){
          foreach($extract->mcq as $mcq){
              $result[$mcq->qno] = $mcq->answer;
          }
          foreach($extract->fillup as $fillup){
             $result[$fillup->qno] = $fillup->answer;
          }
        }
      }
      return view('appl.test.attempt.result');
   }
}







