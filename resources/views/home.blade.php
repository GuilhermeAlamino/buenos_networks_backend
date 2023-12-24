@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Olá Seja Bem vindo :)') }}

                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                        <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
                        <script src="{{ asset('js/enable-push.js') }}" defer></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
