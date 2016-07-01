<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DB;

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

        if($user->image != null)
            $url =url('/').'/photo/'.$user->image;
        else
            $url = "";

        $contacts = explode(";", $user->contacts);

        $xml = "<data><online>$user->online</online><first>$user->name</first><last>$user->last_name</last><image>$url
                </image><username>$user->email</username>";
        $xml .= '<contacts>';
            foreach($contacts as $contact) {
                if ($contact != null) {
                    $profiles = DB::table('users')->where("id", $contact)->get();
                    if(@$profiles != null) {
                        $xml = $xml . "<contact>";
                        $profile = $profiles[0];
                        $profileurl = url('/') . '/photo/' . $profile->image;
                        $xml .= "<online>";
                        $xml.="$profile->last_name";
                        $xml .= "</online><first>$profile->name</first><last>$profile->last_name</last><image>$profileurl</image><username>$profile->email</username>";
                        $xml = $xml . "</contact>";
                    }
                }
            }
        $xml .= '</contacts>';

        $xml = $xml.'</data>';

        return $xml;

    }

    public function changeProfile(Request $request){

        $first_name = $request->input("firstname");
        $last_name = $request->input("lastname");
        $email = $request->input("email");
        $password = $request->input("password");

        $user = Auth::User();

        if(Input::hasfile('image')){
            $image = Input::file('image');
            $upload = base_path().'\\public\\photo';
            $filename = rand(1111111,9999999).'.jpg';
            $image->move($upload, $filename);
            $user->image = $filename;
            $user->online = date_create();
        }


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
