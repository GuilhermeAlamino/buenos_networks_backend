@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <div class="row d-flex align-items-center">

                                <div class="col-6">
                                    {{ __('Lista de Usuários') }}
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <a href="{{ route('dashboard.user.create') }}" class="btn btn-primary btn-sm mt-0">Criar
                                        Usúario</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Tipo</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td scope="col">{{ $user->id }}</td>
                                                    <td scope="col">{{ __('auth.' . $user->role->name) }}</td>
                                                    <td scope="col">{{ $user->name }}</td>
                                                    <td scope="col">{{ $user->email }}</td>
                                                    <td scope="col">
                                                        <a href="{{ route('dashboard.user.edit', $user->id) }}"
                                                            class="btn btn-primary btn-sm mt-0">Editar</a>
                                                        <button type="button" class="btn btn-danger btn-sm mt-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirmDeleteModal{{ $user->id }}">
                                                            Excluir
                                                        </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="confirmDeleteModal{{ $user->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                    Confirmar
                                                                    Exclusão</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Tem certeza de que deseja excluir este usuário?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>

                                                                <!-- Formulário de exclusão -->
                                                                <form
                                                                    action="{{ route('dashboard.user.delete', $user->id) }}"
                                                                    method="POST" style="display:inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Excluir</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection
