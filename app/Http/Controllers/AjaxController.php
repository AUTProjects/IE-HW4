<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class AjaxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function inboxAjax(Request $request){

            $sent = $request->input('sent');
            $inbox = $request->input('inbox');
            $refresh = $request->input('refresh');
            $number = $request->input('nom');
            $sort = $request->input('sortby');
            $mail = $request->input('email');
            $delete = $request->input('delete');
            $compose = $request->input('compose');
            $last = $request->input('last');

            if($compose){
                return view('ComposeEmail');
            }

            if($delete){
                $from = $request->input('from');
                $date = $request->input('date');
                DB::table('mails')->where('from',$from)->where('created_at',$date)->delete();
                return $from." ".$date;
            }

            if($mail)
            {
                $from = $request->input('from');
                $date = $request->input('date');
                $mail = DB::table('mails')->where('from',$from)->where('created_at',$date)->get();
                if(count($mail) == 0)
                    $mail = DB::table('mails')->where('to',$from)->where('created_at',$date)->get();
                return view('ReadEmail')->with('mail',$mail[0]);
            }


            if($sent)
                if($sort == 'sender')
                    $mails = DB::table('mails')->where('type','receive') ->orderBy('from', 'desc')->get();
                elseif($sort == 'attach')
                    $mails = DB::table('mails')->where('type','receive') ->orderBy('from', 'desc')->get();//TODO
                else
                    $mails = DB::table('mails')->where('type','receive') ->orderBy('created_at', 'desc')->get();
            elseif($refresh)
                    $mails = DB::table('mails')->where('type','receive')->where('id','<',$last)->get();
            elseif($inbox ) //TODO
                if($sort == 'sender')
                    $mails = DB::table('mails')->where('type','receive') ->orderBy('from', 'desc')->get();
                elseif($sort == 'attach')
                    $mails = DB::table('mails')->where('type','receive') ->orderBy('from', 'desc')->get();//TODO
                else
                    $mails = DB::table('mails')->where('type','receive') ->orderBy('created_at', 'desc')->get();


            $xml = '<mails>';
                for($x =0; $x < count($mails);$x++){
                    $mail = $mails[$x];
                    if($x == $number && $number != 0)
                        break;
                    $xml = $xml.'<mail>';
                    $xml = $xml.'<from>';
                    $xml = $xml.$mail->from;
                    $xml = $xml.'</from>';

                    $xml = $xml.'<to>';
                    $xml = $xml.$mail->to;
                    $xml = $xml.'</to>';

                    $xml = $xml.'<date>';
                    $xml = $xml.$mail->created_at;
                    $xml = $xml.'</date>';

                    $xml = $xml.'<subject>';
                    $xml = $xml.$mail->title;
                    $xml = $xml.'</subject>';

                    $xml = $xml.'<text>';
                    $xml = $xml.$mail->text;
                    $xml = $xml.'</text>';

                    $xml = $xml.'<id>';
                    $xml = $xml.$mail->id;
                    $xml = $xml.'</id>';

                    $xml = $xml.'</mail>';

                }
                $xml = $xml.'</mails>';
                return $xml;

        }
}
