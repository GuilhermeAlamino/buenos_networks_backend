<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $result = $this->authenticationService->attemptLogin($request);

        if ($result === false) {
            return redirect()
                ->back()
                ->withInput($request->only('email'))
                ->withErrors(['password' => trans('auth.invalid_credentials')]);
        }

        return $result;
    }

    public function delete()
    {
        Auth::logout();

        return redirect('/login');
    }
}
