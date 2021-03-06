<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\File as Obj;
use App\Models\Test\Attempt as Obj2;
use App\Models\Test\Test ;
use App\Models\Test\Writing ;
use Illuminate\Support\Facades\Storage;
use App\User;

use App\Mail\reviewnotify;
use Illuminate\Support\Facades\Mail;
use PDF;

class FileController extends Controller
{
    /*
        Test Tags Controller
    */

    public function __construct(){
        $this->app      =   'test';
        $this->module   =   'file';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj,Obj2 $obj2,Request $request)
    {


        $this->authorize('view', $obj);

        $search = $request->search;

        $item = $request->item;
        if($request->get('type')=='speaking'){
            $tests = Test::whereIn('type_id',[4])->pluck('id');
            $objs = $obj->where('response','LIKE',"%{$item}%")
                    ->whereIn('test_id',$tests)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));
        }else if($request->get('type')=='writing'){
            if(\auth::user()->admin==4)
            {
                $tests = [];
                $attempt_ids = Writing::where('user_id',\auth::user()->id)->pluck('attempt_id');
                $objs = Obj2::whereIn('id',$attempt_ids)->paginate(config('global.no_of_records'));

            }
            else{
                $tests = Test::whereIn('type_id',[3])->pluck('id');
                 if($item){
                        $objs = $obj2->whereHas('user', function ($query) use ($item){
                            $query->where('name', 'like', '%'.$item.'%');
                        })
                        ->with(['user' => function($query) use ($item){
                            $query->where('name', 'like', '%'.$item.'%');
                        }])->orderBy('created_at','desc')
                        ->whereIn('test_id',$tests)->paginate(config('global.no_of_records'));
                        
                    }else{
                        $objs = $obj2
                    ->whereIn('test_id',$tests)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));
                  
                    }
            }

            //$tests = Test::whereIn('type_id',[3])->pluck('id');
            
            
                   

                    
        }else{
            $tests = Test::whereIn('type_id',[3,4])->pluck('id');
            $objs = $obj->where('response','LIKE',"%{$item}%")
                    ->whereIn('test_id',$tests)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));
        }
           
        $view = $search ? 'list': 'index';

        return view('appl.'.$this->app.'.'.$this->module.'.'.$view)
                ->with('objs',$objs)
                ->with('obj',$obj)
                ->with('app',$this);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Obj $obj, Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = Obj::where('id',$id)->first();
        $writing = Writing::where('attempt_id',$id)->first();

        $this->authorize('view', $obj);

        if(!$obj)
            abort(404);

        /* get extension and load player */
        $info = pathinfo(Storage::url($obj->response));

        if(isset($info['extension'])){
            $ext = $info['extension'];

            if(in_array($ext, ['mp3','wav','mkv','mp4','aac','3gp','ogg','mpga'])){
                return view('appl.'.$this->app.'.'.$this->module.'.show')
                        ->with('obj',$obj)->with('app',$this)->with('player',true);
            }else{
                return view('appl.'.$this->app.'.'.$this->module.'.show')
                        ->with('obj',$obj)->with('app',$this)->with('player',false);
            }  
        }else{
            return view('appl.'.$this->app.'.'.$this->module.'.show_write')
                        ->with('obj',$obj)->with('app',$this)
                        ->with('player',false)->with('writing',$writing);
        }
            
    }



    /**
     * Download the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id,Request $request)
    {
        $obj = Obj::where('id',$id)->first();
        $test = $obj->test;
        $user = $obj->user;
        $name ='response_'.$test->slug.'_'.str_replace(' ', '',$user->name);
        
        $info = pathinfo(Storage::url($obj->response));

        if(isset($info['extension'])){
            $ext = $info['extension'];

            if($request->get('pdf')){
                $file = 'feedback/feedback_'.$id.'.pdf';
            }
            else if(in_array($ext, ['mp3','wav','mkv','mp4','aac','3gp','ogg','mpga'])){
                    $file = $obj->response;
            }else if($request->get('word')){
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $section = $phpWord->addSection();
                $text = $section->addText('name');
                $text = $section->addText($obj->response);
                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $objWriter->save($obj->id.'.docx');
                return response()->download(public_path($obj->id.'.docx'));
            }
            else{
               
            }  
        }else{
                if($request->get('pdf')){
                // expert feedback document
                    $file = 'feedback/feedback_'.$id.'.pdf';
                }
                else if($request->get('word')){

                $phpWord = $this->processWord($obj);

                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                try {
                    $objWriter->save('../storage/app/public/response/'.$name.'.docx');
                } catch (Exception $e) {
                }

                return response()->download('../storage/app/public/response/'.$name.'.docx');
                }
                else{
                    
                    $file = 'response/'.$name.'.pdf';
                    $pdf = PDF::loadView('appl.test.file.pdf2',compact('obj'));
                    $pdf->save('../storage/app/public/response/'.$name.'.pdf'); 
                    //user response file (audio or doc)  
                }
        }
        
        if($obj)
            return response()->download('../storage/app/public/'.$file);
        else
            abort(404);
    }


    public function processWord($obj){

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();

        $styleFont = array('bold'=>true, 'size'=>16, 'name'=>'Calibri');

        $section->addText('');
        $section->addText('Name: '.$obj->user->name );

         $section->addText('Test Date: '.date("F j, Y, g:i a",strtotime($obj->created_at)));
        $section->addText('');
        $section->addLine(['weight' => 1, 'width' => 450, 'height' => 0]);
       

        

        $data =[];

        if($obj->test->description){
            
            
            $section->addText('Question'.' ', $styleFont);

            $text = str_replace('</p>', '', $obj->test->description);
            $array = explode('<p>', $text);
            foreach($array as $a){
                $t = strip_tags($a);
                $t = str_replace('&hellip;', '...', $t);
                $t = str_replace('&nbsp;', ' ', $t);
                if($t!="User Response" && trim($t)!="" && trim($t)!=" "){
                    array_push($data, $t);
                    $section->addText($t);
                    $section->addText('');
                }
            }



            //if images
            preg_match_all('/<img[^>]*?\s+src\s*=\s*"([^"]+)"[^>]*?>/i', $obj->test->description, $matches);
        
            foreach($matches[1] as $src){
            $section->addImage($src,array('width' => "250")); 
            $section->addText('');  
            }
            

            $section->addText('');
            $section->addLine(['weight' => 1, 'width' => 450, 'height' => 0]);
            $section->addText('');
            $section->addText('User Response'.' ', $styleFont);
            $section->addText('');


            $text = str_replace('</p>', '', $obj->response);
            $array = explode('<p>', $text);
            foreach($array as $a){
                $t = strip_tags($a);
                $t = str_replace('&nbsp;', ' ', $t);
                if($t!="User Response"){
                    array_push($data, $t);
                    $section->addText($t);
                    $section->addText('');
                }
            }

            preg_match_all('/<img[^>]*?\s+src\s*=\s*"([^"]+)"[^>]*?>/i', $obj->response, $matches2);
        
            foreach($matches2[1] as $src){
            $section->addImage($src,array('width' => "250"));  
            $section->addText(''); 
            }


        }else{

            $section->addText('');
            


            $text = str_replace('</p>', '', $obj->response);
            $array = explode('<p>', $text);


            foreach($array as $a){
                
                $t = strip_tags($a);
                $t = str_replace('&nbsp;', ' ', $t);

                if($t!="User Response" && $t!="Question" && trim($t)!="" && trim($t)!=" "){
                    array_push($data, $t);
                    $section->addText($t);
                    $section->addText('');
                    preg_match_all('/<img[^>]*?\s+src\s*=\s*"([^"]+)"[^>]*?>/i', $a, $matches2);
                    foreach($matches2[1] as $src){
                    $section->addImage($src,array('width' => "250"));  
                    $section->addText(''); 
                    }
                }else if($t=="Question"){
                   $section->addText($t.' ', $styleFont); 
                   $section->addText('');
                }else{
                    $section->addLine(['weight' => 1, 'width' => 450, 'height' => 0]);
                    $section->addText('');
                    $section->addText($t.' ', $styleFont); 
                    $section->addText('');
                }
            }

            

            
            
        }
                
        $section->addText('');
        $section->addText('');
        $section->addText('');
        $section->addLine(['weight' => 1, 'width' => 450, 'height' => 0]);
                    $section->addText('');
        // Add Logo
        $section->addImage("https://i.imgur.com/bILa9ib.png",array('width' => 100));
        $section->addText('');
        $section->addText('We have been the most awarded training centre offering the best coaching
for exams like the GRE, PTE, OET, and IELTS for almost two decades. With
University of Cambridge certified trainers, you can be assured of the highest
levels of training.');
        

        return $phpWord;
        

    }

    

    /**
     * Notify User with Email
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notify($id,Request $request)
    {
        $obj = Obj::where('id',$id)->first();
        $test  = Test::where('id',$obj->test_id)->first();
        $time = $request->get('time');

        $this->authorize('view', $obj);
        $user = User::where('id',$obj->user_id)->first();
        if($obj){

             //Mail notifaction to the user
            if(!$time)
             Mail::to($user->email)->send(new reviewnotify($user,$test));
            else{

                $writing = Writing::where('attempt_id',$id)->first();
                if(!$writing)
                $writing = new Writing();
                $writing->attempt_id = $id;
                $writing->notify = $time;

                $writing->save();

            }

            return view('appl.'.$this->app.'.attempt.alerts.notify')->with('user',$user)->with('time',$time);
        }
        else
            abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj= Obj::where('id',$id)->first();
        $this->authorize('update', $obj);


        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('app',$this);
        else
            abort(404);
    }

    /* assigin writing faculty */
    public function assign($id)
    {
        $obj= Obj::where('id',$id)->first();
        $this->authorize('update', $obj);
        $users = User::where('admin',4)->get();
        $writing = Writing::where('attempt_id',$id)->first();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.assign')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('users',$users)
                ->with('writing',$writing)
                ->with('editor',true)
                ->with('app',$this);
        else
            abort(404);
    }

    /* assign writing update */
    public function assignupdate(Request $request, $id)
    {
        try{
            $obj = Obj::where('id',$id)->first();
            $writing = Writing::where('attempt_id',$id)->first();
            if(!$writing)
            $writing = new Writing();


            $writing->attempt_id = $id;
            $writing->user_id = $request->get('user_id');
            $writing->notify = ($request->get('notify'))? $request->get('notify') : 0;

            $writing->save();

            
            flash('Faculty Assigned')->success();
            return redirect()->route($this->module.'.show',$id);
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                 flash('Some error in updating the record')->error();
                 return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $obj = Obj::where('id',$id)->first();
            $obj->answer = $request->answer;

            /* delete file request */
            if($request->get('deletefile')){
                if(Storage::disk('public')->exists('feedback/feedback_'.$obj->id.'.pdf'))
                    Storage::disk('public')->delete('feedback/feedback_'.$obj->id.'.pdf');
                redirect()->route($this->module.'.show',[$id]);
            }

            /* If file is given upload and store path */
            if(isset($request->all()['file'])){
                $file      = $request->all()['file'];
                $extension = $file->getClientOriginalExtension();

              
                if($extension!='pdf')
                    return abort('403','Only PDF Doc allowed');

                $filename  = 'feedback_'.$obj->id.'.' . $extension;

                $path = Storage::disk('public')->putFileAs('feedback', $request->file('file'),$filename);
            }

            //update writing notifier
            $writing = Writing::where('attempt_id',$id)->first();
            if(!$writing)
            $writing = new Writing();
            $writing->attempt_id = $id;
            $writing->user_id = \auth::user()->id;
            $writing->save();


            $obj->save();
            
            flash('('.$this->app.'/'.$this->module.') item is updated!')->success();
            return redirect()->route($this->module.'.show',$id);
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                 flash('Some error in updating the record')->error();
                 return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Obj::where('id',$id)->first();
        $this->authorize('update', $obj);

        // remove file
        if(Storage::disk('public')->exists($obj->file))
            Storage::disk('public')->delete($obj->file);
        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}
