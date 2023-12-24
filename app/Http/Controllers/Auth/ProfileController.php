<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationSendController;
use App\Http\Requests\ProfileUpdateRequest;
use App\Notifications\UserDataUpdated;
use App\Notifications\UserUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Notification;

class ProfileController extends Controller
{
    protected $notificationController;

    public function __construct(NotificationSendController $notificationController)
    {
        $this->notificationController = $notificationController;
    }

    public function show()
    {

        $user = Auth::user();

        return view('auth.profile.show', ["user" => $user]);
    }

    public function update(ProfileUpdateRequest $request)
    {

        $user = Auth::user();

        $validatedData = $request->validated();

        $user->update($validatedData);

        if ($user->id == Auth::user()->id) {
            $this->notificationController->notifyUserUpdated(Auth::user());
        } else {
            $this->notificationController->storePushSubscription($request);
            $this->notificationController->notifyUserDataUpdated($user);
        }

        return redirect()->route('dashboard.profile.show')->with('success', 'Perfil atualizado com sucesso!');
    }
}
