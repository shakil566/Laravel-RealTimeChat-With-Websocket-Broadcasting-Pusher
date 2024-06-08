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
        try {
            event(new PublicMessaging($request->message ?? ''));

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }


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
                'message' => $request->message,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            event(new PrivateMessaging($messageData));

            return response()->json(['success' => true, 'data' => $messageData]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

    }
    public function messageBody(Request $request)
    {
        try {
            $receiverInfo = User::where('id', $request->receiver_id)->select('id', 'name')->first();
            $messageInfo = Message::where('receiver_id', $request->receiver_id)
                ->where('sender_id', Auth::user()->id)
                ->orWhere('receiver_id', Auth::user()->id)
                ->orWhere('sender_id', $request->receiver_id)
                ->get();
            // dd($receiverName->name, $messageInfo);

            $view = view('private_messaging.prev_messages', compact('messageInfo', 'receiverInfo'))->render();
            return response()->json(['success' => true, 'html' => $view]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
