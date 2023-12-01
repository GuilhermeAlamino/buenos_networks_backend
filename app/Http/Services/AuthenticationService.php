<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthenticationService
{
  public function attemptLogin($request)
  {
    $email = mb_strtolower($request->input('email'));
    $throttleKey = "{$email}|{$request->ip()}";

    if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
      $seconds = RateLimiter::availableIn($throttleKey);
      $message = trans('auth.throttle', ['seconds' => $seconds]);

      throw ValidationException::withMessages(['password' => $message])->status(429);
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      RateLimiter::clear($throttleKey);
      return redirect()->intended('/dashboard');
    }

    RateLimiter::hit($throttleKey);

    return false;
  }
}
