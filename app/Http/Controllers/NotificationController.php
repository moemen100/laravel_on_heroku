<?php

namespace App\Http\Controllers;

use App\notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            foreach ($request['notifications'] as $notification) {
                $notification = notification::find($notification);

                $notification->update(['read' => 1]);
            }
            return 0;
        }
        $notifications = notification::where('user_id', '=', Auth::User()->id)
            ->orderBy('id', 'desc')
            ->get();
        foreach ($notifications as $item) {
            $item->update(['read' => 1]);
        }

        return view('notifications', compact('notifications'));
    }

}
