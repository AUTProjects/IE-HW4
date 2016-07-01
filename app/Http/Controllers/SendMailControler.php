<?php

namespace App\Http\Controllers;

use App\Mails;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SendMailControler extends Controller
{
    public function sendMail(Request $request){


        if(Input::hasfile('attachment')){
            $image = Input::file('attachment');
            $upload = base_path().'\\public\\attachment';
            $filename = rand(1111111,9999999)       ;
            $image->move($upload, $filename);
        }else
            $filename = "0";

        $user = Auth::User();

        $mail = new Mails();
        $mail->attachment = $filename;
        $mail->from = $user->email;
        $mail->to = $request->input('to');
        $mail->title = $request->input('subject');
        $mail->text = $request->input('text');
        $mail->type = 'send';

        $mail->save();
        return view('home')->with('user',$user);
    }
}
