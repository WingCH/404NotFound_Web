<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;

class MailController extends Controller
{
    public function getSend($user_id, $type){
    	//而家系sync
    	Mail::send('email.test',[],function($message){
    		$message->subject('Laravel 5 Mail');
		    $message->to('jason021075@gmail.com');
		});
    }
}
