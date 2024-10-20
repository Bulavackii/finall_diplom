@extends('layouts.client')

@section('title', 'Профиль')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header bg-primary text-white text-center">
                <h2 class="mb-0">Профиль пользователя</h2>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <p class="h5 mb-4"><strong>Имя:</strong> {{ $user->name }}</p>
                        <p class="h5 mb-4"><strong>Email:</strong> {{ $user->email }}</p>
                        <hr>
                        <p class="text-muted text-center">Ваш профиль содержит основную информацию о вас, используемую для бронирования билетов и связи.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-image: url('{{ asset('client/i/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
            border: none;
        }

        .card-header {
            font-size: 1.5rem;
            padding: 15px;
        }

        .card-body {
            padding: 20px;
        }

        .h5 {
            font-size: 1.2rem;
            color: #333;
        }

        .text-muted {
            font-size: 0.9rem;
            color: #777;
        }

        hr {
            margin: 20px 0;
            border-color: rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
