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
    public function activation(Request $request)
    {
    	$user = \auth::user();


    	/* update phone number */
    	if($request->get('type')=='update_phone'){
    		$phone = $request->get('number');
    		$user_exists = User::where('phone',$phone)->first();
    		if(!$user_exists){
    			$user->phone = $phone;
    			$user->save();
    			$message = 'User phone number successfully updated to '.$phone;
    			flash($message)->success();	
    		}else{
    			$message = 'The given phone number '.$phone.' is already in use. Kindly use a different number.';
    			flash($message)->error();
    		}
    		
    	}

    	/* update email */
    	if($request->get('type')=='update_email'){
    		$email = $request->get('email');
    		$user_exists = User::where('email',$email)->first();
    		if(!$user_exists){
    			$user->email = $email;
    			$user->save();
    			$message = 'User email address successfully updated to '.$email;
    			flash($message)->success();	
    		}else{
    			$message = 'The given email address '.$email.' is already in use. Kindly use a different address.';
    			flash($message)->error();
    		}
    	}

    	/* Resend Email */
    	if($request->get('resend_email')){
    		if($user->activation_token!=1){
    			Mail::to($user->email)->send(new EmailActivation($user));
    			$message = 'Successfully resent activation email to '.$user->email;
    			flash($message)->success();	
    		}else{
    			$message = 'Email already verified !';
    			flash($message)->warning();	
    		}
    		
    	}


    	/* Resend SMS */
    	if($request->get('resend_sms')){
    		if($user->sms_token!=1){
    			$user->resend_sms($user->phone,$user->sms_token);
    			$message = 'Successfully resent the activation code to '.$user->phone;
    			flash($message)->success();	
    		}else{
    			$message = 'Phone number already verified !';
    			flash($message)->warning();	
    		}
    		
    	}

    	

    	return view('appl.user.verify.activation')
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
        return view('appl.user.verify.message')
                ->with('message',$message);
    }

    /**
     * Verify Phone number
     *
     * @return \Illuminate\Http\Response
     */
    public function sms(Request $request)
    {
    	$sms_code = $request->get('sms_code');
    	$user = User::where('sms_token',$sms_code)->first();

    	if($user && $sms_code){
    		$user->sms_token =1;
    		$user->save();
    		$message = 'Successfully verified user phone number.';
    		flash($message)->success();
    	}else{
    		$message = 'Invalid phone verification code';
    		flash($message)->error();
    	}
        return redirect()->route('activation');

    }


    
}
