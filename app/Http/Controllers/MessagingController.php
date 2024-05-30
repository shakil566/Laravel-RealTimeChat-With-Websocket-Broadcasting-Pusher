<?php

namespace App\Http\Controllers;

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
}
