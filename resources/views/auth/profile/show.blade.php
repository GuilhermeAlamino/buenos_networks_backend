@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Meu Perfil') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('dashboard.profile.update') }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Digite seu nome" value="{{ $user->name }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group mt-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" aria-describedby="emailHelp" placeholder="Digite seu email"
                                    name="email" value="{{ $user->email }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="emailHelp" class="form-text text-muted">Nunca compartilharemos seu e-mail com
                                    mais ninguém.</small>
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Nova Senha">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Confirmação Senha</label>
                                <input id="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" placeholder="Nova Senha" autocomplete="Nova-senha">
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Tipo</label>
                                <select class="form-control" name="role_id">
                                    @can('isAdmin', 'App/Models/User')
                                        <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                    @endcan
                                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Comum</option>
                                </select>
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
@endsection
