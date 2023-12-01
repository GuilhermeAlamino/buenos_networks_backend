@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="global-container">
                    <div class="card login-form">
                        <div class="card-body">
                            <h3 class="card-title mt-4 text-center">Registrar</h3>
                            <div class="card-text">
                                <!--
                                                                                                                                                                                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                                <form method="POST" action="{{ route('register.store') }}">
                                    @csrf <!-- to error: add class "has-danger" -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nome</label>
                                        <input type="text"
                                            class="form-control form-control-md @error('name') is-invalid @enderror"
                                            id="name" value="{{ old('name') }}" name="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email"
                                            class="form-control form-control-md @error('email') is-invalid @enderror"
                                            id="email" value="{{ old('email') }}" name="email"
                                            aria-describedby="emailHelp">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="exampleInputEmail1">Senha</label>
                                        <input type="password"
                                            class="form-control form-control-md @error('password') is-invalid @enderror"
                                            id="password" value="{{ old('password') }}" name="password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="exampleInputPassword1">Confirmação de Senha</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control form-control-md" value="{{ old('password_confirmation') }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                                        </div>
                                    </div>

                                    <div class="sign-up">
                                        Lembrou ? <a href="{{ route('login.index') }}">Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header">{{ __('Registrar') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirmação de senha') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
