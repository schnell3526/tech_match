<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatMessageReceived;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Mail\SampleNotification;
use Mail;

class ChatController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(int $id)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
        $login_id = Auth::id();
        $login_user = User::find($login_id);
        $engineer = $login_user->engineer()->first();
        if(!$engineer)
        {
            return redirect('/mypage/create');
        }
        $matchThese = ['send_user_id' => $login_id, 'receive_user_id' => $id];
        $matchThose = ['send_user_id' => $id, 'receive_user_id' => $login_id];
        $messages = Message::where(function($query) use($login_id, $id){
            $query->where('send_user_id', $login_id)->where('receive_user_id', $id);
        })->orWhere(function($query) use($login_id, $id){
            $query->where('send_user_id', $id)->where('receive_user_id', $login_id);
        })->get();
        $user = User::find($id);
        Message::where('receive_user_id', $login_id)->where('checked', 0)->update([ 'checked' => 1]);
        return view('chat', [
            'login_user' => $login_user,
            'user' => $user,
            'messages' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->message = $request->message;
        $message->send_user_id = $request->send;
        $message->receive_user_id = $request->receive;
        $message->created_at = $request->time;
        $message->save();
        
            
        

        event(new ChatMessageReceived($request->all()));
        
        $mailSendUser = User::where('id', $request->receive)->first();
        $to = $mailSendUser->email;
        Mail::to($to)->send(new SampleNotification());
        return true;
    }
}
