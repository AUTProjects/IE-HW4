<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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

        $user2 = User::where('id',$request->input('id'))->get();
        if(count($user)) {
            $user2[0]->notif .= $user->name . " " . $user->last_name;
            $user2[0]->save();
        }
        return redirect()->back();
    }

    function blockUser(Request $request){
        $user =Auth::User();
        $user->blocks = $request->input('id').';'.$user->blocks;
        $user->save();
        return redirect()->back();
    }
}



