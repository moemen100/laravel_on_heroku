<?php

namespace App\Http\Controllers;

use App\friendrequest;
use App\Helpers\CommonHelper;
use App\user;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use LaravelPusher;

class FriendRequestController extends Controller
{
    //
    public function index()
    {
        $userRequests = friendrequest::where('user_received_id', Auth::User()->id)
            ->where('status', 'pending')->get();

        return view('friends_requests', compact('userRequests'));
    }

    public function store(user $user)
    {
        friendrequest::create([
            'user_requested_id' => Auth::User()->id,
            'user_received_id' => $user->id,
            'status' => 'pending',
        ]);

        CommonHelper::Notify("friend_request", $user);
        return redirect()->back();
    }

    public function accept(friendrequest $friendrequest)
    {
        $friendrequest->status = "accepted";
        $friendrequest->update();
        CommonHelper::Notify("friend_request_accepted", $friendrequest);
        return redirect()->back();
    }

    public function delete(friendrequest $friendrequest)
    {
        $friendrequest->delete();
        return redirect()->back();

    }
}
