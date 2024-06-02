<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessaging;
use App\Events\PublicMessaging;
use Illuminate\Http\Request;

class MessagingController extends Controller
{
    public function index(Request $request){
        return view('public_messaging.index');
    }
    public function publicMessageSend(Request $request){
        event(new PublicMessaging($request->message ?? ''));
        // dd($request);
    }

    public function privateIndex(Request $request){
        return view('private_messaging.index');
    }
    public function privateMessageSend(Request $request){
        // $receiverId = $request->input('receiver_id');
        $message = $request->message ?? '';
        $receiverId = 3;
        event(new PrivateMessaging($message));

        return response()->json(['message' => 'Message Sent!'], 200);
    }
}
