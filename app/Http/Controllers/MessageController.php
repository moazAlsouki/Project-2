<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    //
    public function getAllMessages()
    {
        return Message::all();
    }
    public function GetMessage($recid)
    {
        return Message::find($recid);
    }

    public function sendMessage(Request $request)
    {
        $message= new Message();
        $message->sender_id=$request->sender_id;
        $message->reciver_id=$request->reciver_id;
        $message->date=$request->date;
        $message->information=$request->information;
        $message->shown=false;
        $message->save();
        return $message;
    }

    public function reciveMessage()
    {
        $messages=DB::table('messages')
        ->where('reciver_id','=',Auth::user()->id)
        ->where('shown','=',false)
        ->get();
        return $messages;
    }
}
