<?php

namespace App\Http\Controllers;

use App\friendrequest;
use App\user;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(user $user)
    {
        $isFriend = friendrequest::where('user_received_id', Auth::User()->id)
            ->where('user_requested_id', $user->id)
            ->Orwhere('user_requested_id', Auth::User()->id)
            ->where('user_received_id', $user->id)->first();

        return view("profile", compact("user", "isFriend"));
    }
}
