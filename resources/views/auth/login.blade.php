@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="global-container">
                    <div class="card login-form">
                        <div class="card-body">
                            <h3 class="card-title mt-4 text-center">Login</h3>
                            <div class="card-text">
                                <!--
                                                                                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                                <form method="POST" action="{{ route('login.store') }}">
                                    @csrf <!-- to error: add class "has-danger" -->
                                    <div class="form-group">
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
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control form-control-md @error('password') is-invalid @enderror"
                                            id="password" value="{{ old('password') }}">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 d-flex justify-content-center">
                                            <a href="#" style="float:right;font-size:12px;">Esqueceu sua senha?</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </div>

                                    <div class="sign-up">
                                        Não tem conta ? <a href="{{ route('register.index') }}">Registrar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
