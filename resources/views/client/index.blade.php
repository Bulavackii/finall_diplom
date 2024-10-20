@extends('layouts.client')

@section('title', 'Сеансы')

@section('header')
    <div class="section-title text-center">
        Сеансы
    </div>
@endsection

@section('content')
    <div class="container mt-2"> 
        <div class="row justify-content-center">
            @if($movies->isEmpty())
                <p class="text-white text-center">В настоящее время нет доступных сеансов.</p>
            @else
                @foreach($movies as $movieGroup)
                    @php
                        $firstSession = $movieGroup->first();
                        $movie = $firstSession->movie;
                    @endphp
                    <div class="col-sm-6 col-lg-4 d-flex align-items-stretch">
                        <div class="card movie-card shadow-lg">
                            @if($movie->poster_url)
                                <img src="{{ asset($movie->poster_url) }}" class="card-img-top" alt="{{ $movie->title }}">
                            @endif
                            <div class="card-body movie-info">
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <p class="card-text">
                                    {{ Str::limit($movie->description, 100) }}
                                    <a href="{{ route('client.movie.details', $movie->id) }}" class="text-primary">
                                        Подробнее <i class="bi bi-info-circle-fill"></i>
                                    </a>
                                </p>
                                <p><strong>Длительность:</strong> {{ $movie->duration }} минут</p>
                                <p><strong>Жанр:</strong> {{ $movie->genre }}</p>
                                <p><strong>Страна:</strong> {{ $movie->country }}</p>

                                <h6>Доступные сеансы:</h6>
                                <ul class="list-unstyled">
                                    @foreach($movieGroup as $session)
                                        <li class="mb-2">
                                            <span>Время: {{ $session->start_time->format('d.m.Y H:i') }} в зале {{ $session->cinemaHall->name }}</span>
                                            <a href="{{ route('client.hall', $session->id) }}" class="btn btn-sm btn-warning mt-1">
                                                Забронировать билеты
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <style>
        body {
            background-image: url('{{ asset('client/i/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 10px;
            width: 50%;
            margin: 0 auto 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .movie-card {
            max-width: 400px;
            margin: 15px auto;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border-radius: 15px;
            border: none;
            overflow: hidden;
        }

        .movie-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .movie-card img {
            max-height: 400px;
            object-fit: cover;
            border-bottom: 4px solid #ffc107;
        }

        .movie-info {
            text-align: left;
            padding: 20px;
            background-color: #fff;
            border-radius: 0 0 15px 15px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            font-size: 1.2rem;
            color: #555;
        }

        .card-text a {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        .card-text a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .list-unstyled li {
            font-size: 1rem;
            color: #444;
            margin-bottom: 10px;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
            border-radius: 20px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Инициализация dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownElements = document.querySelectorAll('.dropdown-toggle');
            if (dropdownElements.length) {
                dropdownElements.forEach(function(dropdownElement) {
                    new bootstrap.Dropdown(dropdownElement); // Явная инициализация dropdown
                });
            }
        });
    </script>
@endpush
