<?php

namespace App\Http\Controllers;

use App\Mails;
use Carbon\Carbon;
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
                DB::table('mails')->where('id', $mail[0]->id)->update(array('read' => 1));
                return view('ReadEmail')->with('mail',$mail[0]);
            }

ir
            if($sent)
                if($sort == 'sender')
                    $mails = DB::table('mails')->where('type','send') ->orderBy('from', 'desc')->get();
                elseif($sort == 'attach')
                    $mails = DB::table('mails')->where('type','send')->where('attachment','!=','0') ->get();//TODO
                else
                    $mails = DB::table('mails')->where('type','send') ->orderBy('created_at', 'desc')->get();
            elseif($refresh)
                    $mails = DB::table('mails')->where('type','receive')->where('created_at','>',$last)->get();
            elseif($inbox ) //TODO
                if($sort == 'sender')
                    $mails = DB::table('mails')->where('type','receive') ->orderBy('from', 'desc')->get();
                elseif($sort == 'attach')
                    $mails = DB::table('mails')->where('type','receive')->where('attachment','!=','0')->get();//TODO
                else
                    $mails = DB::table('mails')->where('type','receive') ->orderBy('created_at', 'desc')->get();


            $xml = '<mails>';
            $now = Carbon::now();
            $xml .= "<update>$now</update>";
                for($x =0; $x < count($mails);$x++){
                    $mail = $mails[$x];
                    if($x == $number && $number != 0)
                        if(!$refresh)
                        break;
                    if($mail->read == "0")
                        $xml = $xml.'<mail read="yes">';
                    else
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
