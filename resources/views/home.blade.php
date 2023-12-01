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
                        <script>
                            var firebaseConfig = {
                                apiKey: "AIzaSyDMMoVG0d0tlNcZH0kIR2FFT_WcNzq5iVU",
                                authDomain: "notifications-37371.firebaseapp.com",
                                projectId: "notifications-37371",
                                storageBucket: "notifications-37371.appspot.com",
                                messagingSenderId: "323633312623",
                                appId: "1:323633312623:web:2392f121cd5aabef24ee9a",
                                measurementId: "G-6645YF2CXF"
                            };

                            firebase.initializeApp(firebaseConfig);
                            const messaging = firebase.messaging();

                            document.addEventListener("DOMContentLoaded", function(event) {

                                async function startFCM() {
                                    try {
                                        await messaging.requestPermission();
                                        const token = await messaging.getToken();

                                        const headers = new Headers();
                                        headers.append('Content-Type', 'application/json');
                                        headers.append('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]')
                                            .getAttribute(
                                                'content'));

                                        const response = await fetch('{{ route('dashboard.store.token') }}', {
                                            method: 'POST',
                                            headers: headers,
                                            body: JSON.stringify({
                                                token: token
                                            })
                                        });


                                    } catch (error) {
                                        console.log(error.message);
                                    }
                                }

                                startFCM();

                                messaging.onMessage(function(payload) {
                                    const title = payload.notification.title;
                                    const options = {
                                        body: payload.notification.body,
                                        icon: payload.notification.icon,
                                    };
                                    new Notification(title, options);
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
