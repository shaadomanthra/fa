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

        return view('appl.test.attempt.try')
                ->with('player',true)
                ->with('try',true)
                ->with('app',$this)
                ->with('qcount',$qcount)
                ->with('test',$test);

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







