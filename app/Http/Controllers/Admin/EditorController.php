<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditorController extends Controller
{
    
	public function index()
    {
    	return view('appl.admin.editor.index');
    }

    public function page(Request $r)
    {
    	$filename = $r->get('filename');
    	if(!$filename)
    		abort('403','filename not given as input');

    	//dd($filename);
    	if(!file_exists($filename))
    		abort('403','file doesnot exist');

    	if($r->get('code')){
    		$code = $r->get('code');
    		file_put_contents($filename,$code);
    		flash('File ('.$filename.') successfully updated!')->success();
            return redirect()->route('editor.index');
    	}else{
    		$code = file_get_contents($filename);
    	}
    	
    	return view('appl.admin.editor.page')->with('code',$code)->with('filename',$filename);
    }

}
