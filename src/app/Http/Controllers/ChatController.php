<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChatController extends Controller
{
    public function index(int $id)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
        $login_id = Auth::id();
        $login_user = User::find($login_id);
        $matchThese = ['send_user_id' => $login_id, 'receive_user_id' => $id];
        $orThose = ['send_user_id' => $id, 'receive_user_id' => $login_id];
        $messages = Message::where($matchThese)->orWhere($orThose)->get();
        $user = User::find($id);
        return view('chat', [
            'login_user' => $login_user,
            'user' => $user,
            'messages' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $insert = [
            'send_user_id' => $request->input('send_user'),
            'receive_user_id' => $request->input('receive_user'),
            'message' => $request->input('message'),
        ];

        try{
            Message::insert($insert);
        }catch(\Exception $e){
            return false;
        }

        event(new ChatMessageReceived($request->all()));

        return true;
    }
}
