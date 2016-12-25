<?php

namespace App\Helpers;

use App\notification;
use App\user;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use LaravelPusher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommonHelper
{
    public static function Notify($type, $attributes)
    {
        $pusher = App::make('pusher');

        if ($type == "friend_request") {
            $notification = notification::create([
                'user_id' => $attributes->id
                , 'notification' => "You have friend request from " . Auth::User()->first_name,
                'type' => "info",
                'read' => 0,
                'url' => route("friends.requests"),
                'message' => "Go to friend request",
                'icon' => "glyphicon glyphicon-user"
            ]);
            $pusher->trigger('notifications', 'new_friend_request', ['message' => $notification]);
        }

        if ($type == "friend_request_accepted") {
            notification::create([
                'user_id' => $attributes->userRequested->id,
                'notification' => "Your friend request to " . Auth::User()->first_name . " has been accepted",
                'type' => "success",
                'read' => 0,
                'message' => "Go to friend request",
                'icon' => "glyphicon glyphicon-user"
            ]);
        }
    }

    public static function getNotification(User $user)
    {
        return notification::where('user_id', '=', $user->id)->where('read', '=', 0)->get();

    }
}