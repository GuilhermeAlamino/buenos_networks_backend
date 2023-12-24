<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationSendController;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Notifications\UserDataUpdated;
use App\Notifications\UserUpdated;
use Notification;

class UserController extends Controller
{

    protected $notificationController;

    public function __construct(NotificationSendController $notificationController)
    {
        $this->notificationController = $notificationController;
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

        if ($user->id == Auth::user()->id) {
            $this->notificationController->notifyUserUpdated(Auth::user());
        } else {
            $this->notificationController->storePushSubscription($request);
            $this->notificationController->notifyUserDataUpdated($user);
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
