<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
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
            $this->notificationService->sendNotification('Parabéns', 'Você atualizou seu registro.', Auth::user()->device_token);
        } else {
            $this->notificationService->sendNotification('Atualizaram o seu registro', 'Usúario: ' . Auth::user()->name, $user->device_token);
        }

        return redirect()->route('dashboard.profile.show')->with('success', 'Perfil atualizado com sucesso!');
    }
}
