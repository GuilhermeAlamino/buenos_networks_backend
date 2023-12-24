<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserDataUpdated;
use App\Notifications\UserUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;

class NotificationSendController extends Controller
{
    public function store(Request $request)
    {
        $this->storePushSubscription($request);

        return response()->json(['success' => true], 200);
    }

    public function storePushSubscription(Request $request)
    {
        $this->validate($request, [
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);

        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = Auth::user();
        $user->updatePushSubscription($endpoint, $key, $token);
    }

    public function notifyUserDataUpdated($notifiable)
    {
        Notification::send($notifiable, new UserDataUpdated);
    }
    
    public function notifyUserUpdated($notifiable)
    {
        Notification::send($notifiable, new UserUpdated);
    }
}
