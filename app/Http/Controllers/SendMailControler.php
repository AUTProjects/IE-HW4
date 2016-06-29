<?php

namespace App\Http\Controllers;

use App\Mails;
use Illuminate\Http\Request;

use App\Http\Requests;

class SendMailControler extends Controller
{
    public function sendMail(Request $request){
        $mail = new Mails();
        //$mail->from TODO
        $mail->to = $request->input('to');
        $mail->title = $request->input('subject');
        $mail->text = $request->input('text');
        $mail->type = 'send';
        $mail->save();
        return view('home');
    }
}
