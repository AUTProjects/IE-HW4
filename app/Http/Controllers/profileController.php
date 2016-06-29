<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProfile(Request $request){
        $ajax = $request->input('ajax');
        $user = Auth::User();
        if(!$ajax)
            return view('profile');

        $xml = "<data><first>$user->name</first><last>$user->last_name</last><username>$user->email</username></data>";
        return $xml;

    }

    public function changeProfile(Request $request){
        $first_name = $request->input("firstname");
        $last_name = $request->input("lastname");
        $email = $request->input("email");
        $password = $request->input("password");

        $user = Auth::User();

        if($first_name!=null)
            $user->name = $first_name;

        if($last_name!=null)
            $user->last_name = $last_name;

        if($email!=null)
            $user->email = $email;

        if($password!=null)
            $user->password = $password;

        $user->save();
        return redirect('/');
    }


}
