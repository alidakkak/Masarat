<?php

namespace App\Http\Controllers;

use Pusher\Pusher;

use Illuminate\Http\Request;
use App\Events\PusherBroadcast;
use App\CustomResponse\UserServise;


class ChatController extends Controller
{
    public function chat($user_id, UserServise $user) {
        $receiver = $user->getUser($user_id);
        return $receiver;
    }

    public function sendMessage($user_id, Request $request , UserServise $user) {
        $user->sendMessage($user_id , $request->message);
    }

}
