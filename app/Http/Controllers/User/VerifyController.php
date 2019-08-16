<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\EmailActivation;

use App\Mail\usercreate;
use Illuminate\Support\Facades\Mail;

class VerifyController extends Controller
{
	/**
     * Verify Email
     *
     * @return \Illuminate\Http\Response
     */
    public function email_send(Request $request)
    {
    	$user = \auth::user();
    	if($request->get('resend')){
    		if($user->activation_token!=1){
    			Mail::to($user->email)->send(new EmailActivation($user));
    			$message = 'Successfully resent activation email to '.$user->email;
    			flash($message)->success();	
    		}else{
    			$message = 'Email already verified !';
    			flash($message)->warning();	
    		}
    		
    	}
    	return view('appl.user.verify.email')
                ->with('user',$user);
    }
    /**
     * Verify Email
     *
     * @return \Illuminate\Http\Response
     */
    public function email($code,Request $request)
    {
    	$activation_code = $code;
    	$email = $request->get('email');
    	if(!$email)
    		abort('403','Email not found');
    	$user = User::where('email',$email)->first();

    	if($activation_code == $user->activation_token){
    		$user->activation_token =1;
    		$user->save();
    		$message = 'Successfully verified user email';
    		flash($message)->success();
    	}else if($user->activation_token == 1){
    		$message = 'Email verification already completed';
    		flash($message)->warning();
    	}else{
    		$message = 'Invalid email verification code';
    		flash($message)->error();
    	}
        return redirect()->route('email.sendcode');
    }

    /**
     * Verify Phone number
     *
     * @return \Illuminate\Http\Response
     */
    public function sms($code,Request $request)
    {

    }
}
