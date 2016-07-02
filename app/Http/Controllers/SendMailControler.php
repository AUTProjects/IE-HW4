<?php

namespace App\Http\Controllers;

use App\Mails;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class SendMailControler extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function sendMail(Request $request){


        if(Input::hasfile('attachment')){
            $image = Input::file('attachment');
            $upload = base_path().'\\public\\attachment';
            $filename = rand(1111111,9999999)       ;
            $image->move($upload, $filename);
        }else
            $filename = "0";

        $user = Auth::User();

        $contacts = explode(";",$user->contacts);
        $mails = array();

        foreach($contacts as $contact){
            $p = DB::table('users')->where('id',$contact)->get();

            if(count($p) != 0)
              array_push($mails,$p[0]->email);
        }

        $mail = new Mails();
        $mail->attachment = $filename;
        $mail->from = $user->email;
        $mail->to = $request->input('to');
        $mail->title = $request->input('subject');
        $mail->text = $request->input('text');
        $mail->type = 'send';
        echo in_array($mail->to,$mails);
        if(!in_array($mail->to,$mails))
            return view('ComposeEmail')->with('error','1');

        $mail->save();
        return view('home')->with('user',$user);
    }
}
