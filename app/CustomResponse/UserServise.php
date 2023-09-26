<?php

namespace App\CustomResponse;

use App\Events\ChatSent;
use App\Models\User;
use App\Models\Massages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServise {

    public function getUser($user_id) {
        return User::where('id', $user_id)->first();
    }

    public function createUser(array $date):User {
        $date['password'] = Hash::make($date['password']);
        return User::create($date);
    }
    
    public function sendMessage($user_id, $message) {
      return  $User = Auth::user()->id;
        $date['sender'] = $User;
        $date['receiver'] = $user_id;
        $date['message'] = $message;
        Massages::create($date);
        $reciever = $this->getUser($user_id);
        \broadcast(new ChatSent($reciever, $message));
    }
}