@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="container">
                    <div class="card">
                        <div class="card-header">{{ __('Criar Usúario') }}</div>

                        <div class="card-body">
                            <div class="card-text">
                                <form method="POST" action="{{ route('dashboard.user.store') }}">
                                    @csrf
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
                                        <small id="emailHelp" class="form-text text-muted">Nunca compartilharemos seu e-mail
                                            com
                                            mais ninguém.</small>
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

                                    <div class="form-group mt-3">
                                        <label for="password">Tipo</label>
                                        <select class="form-control @error('role_id') is-invalid @enderror" name="role_id"
                                            id="role_id">
                                            <option selected value="" disabled>Selecione</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Comum</option>
                                        </select>
                                        @error('role_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Salvar</button>
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
