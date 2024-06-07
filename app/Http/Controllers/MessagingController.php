<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessaging;
use App\Events\PublicMessaging;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagingController extends Controller
{
    public function index(Request $request)
    {
        return view('public_messaging.index');
    }
    public function publicMessageSend(Request $request)
    {
        event(new PublicMessaging($request->message ?? ''));
        // dd($request);
    }

    public function privateIndex(Request $request)
    {
        $userArr = User::whereNot('id', Auth::user()->id)->get();
        return view('private_messaging.index')->with(compact('userArr'));
    }
    public function privateMessageSend(Request $request)
    {
        try {
            $messageData = Message::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $request->receiver_id,
                'message' => $request->message
            ]);

            event(new PrivateMessaging($messageData));
            
            return response()->json(['success' => true, 'data' => $messageData]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }


        return response()->json(['message' => 'Message Sent!'], 200);
    }
    public function messageBody(Request $request)
    {
        // dd($request->all());
        try {
            $receiverName = User::where('id', $request->receiver_id)->select('name')->first();
            $messageInfo = Message::where('receiver_id', $request->receiver_id)->where('sender_id', Auth::user()->id)->get();
            // dd($receiverName, $messageInfo);
            return response()->json(['success' => true, 'receiver' => $receiverName, 'data' => $messageInfo]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }


        return response()->json(['message' => 'Message Sent!'], 200);
    }
}
