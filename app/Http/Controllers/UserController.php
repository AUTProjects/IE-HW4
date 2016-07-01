<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Monolog\Handler\SyslogUdp\UdpSocket;

class UserController extends Controller
{
    function getUsers(){
        $users = User::All();
        $contacts = explode(";",Auth::User()->contacts);
        foreach($users as $user)
        {
            if (in_array($user->id, $contacts)) {
                $user->id = 0;
            }
        }
        return view('Users')->with('contacts',$users);
    }


    function addUser(Request $request){
        $user =Auth::User();
        $user->contacts = $request->input('id').';'.$user->contacts;
        $user->save();
        return redirect()->back();
    }

    function blockUser(Request $request){
        $user =Auth::User();
        $user->blocks = $request->input('id').';'.$user->blocks;
        $user->save();
        return redirect()->back();
    }
}



