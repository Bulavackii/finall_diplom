@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden;">
                <div class="card-header bg-primary text-white text-center" style="border-radius: 15px 15px 0 0;">
                    <h2 class="mb-0">Добавить новый фильм</h2>
                </div>
                <div class="card-body" style="background-color: #f8f9fa;">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Название фильма:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="Введите название фильма">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Описание:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Введите описание фильма">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Страна:</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country') }}" required placeholder="Введите страну производства">
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="genre" class="form-label">Жанр:</label>
                            <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" value="{{ old('genre') }}" required placeholder="Введите жанр фильма">
                            @error('genre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">Длительность (в минутах):</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration') }}" required min="1" placeholder="Введите длительность фильма в минутах">
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="poster" class="form-label">Постер фильма:</label>
                            <input type="file" class="form-control @error('poster') is-invalid @enderror" id="poster" name="poster" accept="image/*" onchange="previewImage(event)">
                            @error('poster')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="posterPreview" class="img-fluid mt-3 d-none" alt="Предпросмотр постера" style="max-height: 300px;">
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary me-3">Отмена</a>
                            <button type="submit" class="btn btn-primary">Добавить фильм</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        const file = event.target.files[0];
        
        if (file.size > 2 * 1024 * 1024) { // Ограничение на размер файла 2 МБ
            alert("Размер файла слишком большой. Максимальный размер — 2 МБ.");
            event.target.value = ""; // Очищаем значение файла
            return;
        }

        reader.onload = function() {
            const output = document.getElementById('posterPreview');
            output.src = reader.result;
            output.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
</script>
@endpush
