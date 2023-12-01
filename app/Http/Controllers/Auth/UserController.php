<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Services\NotificationService;
use App\Models\User;
use App\Notifications\UserRegisteredNotification;

class UserController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {

        $users = User::with('role')->get();

        return view('auth.user.index', ["users" => $users]);
    }

    public function create()
    {

        return view('auth.user.create');
    }

    public function store(UserStoreRequest $request)
    {

        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role_id' => $validatedData['role_id'],
        ]);

        $user->notify(new UserRegisteredNotification());

        return redirect()->route('dashboard.user.create')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {

        $user = User::where('id', $id)->first();

        return view('auth.user.edit', ["user" => $user]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        $validatedData = $request->validated();

        $user->update($validatedData);

        if ($id == Auth::user()->id) {
            $this->notificationService->sendNotification('Parabéns', 'Você atualizou seu registro.', Auth::user()->device_token);
        } else {
            $this->notificationService->sendNotification('Atualizaram o seu registro', 'Usúario: ' . Auth::user()->name, $user->device_token);
        }

        return redirect()->route('dashboard.user.edit', $id)->with('success', 'Usúario atualizado com sucesso!');
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('dashboard.user.index', $id)->with('success-delete', 'Usúario deletado com sucesso!');
    }
}
