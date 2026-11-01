<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Добавить альбом</title>
    @vite(['resources/scss/styles.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Добавить альбом</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Название альбома</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Исполнитель</label>
            <input type="text" name="artist" class="form-control" required value="{{ old('artist') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Тип (метка)</label>
            <input type="text" name="label" class="form-control" required value="{{ old('label', 'Студийный альбом') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea name="full_description" class="form-control" rows="4">{{ old('full_description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Дата релиза</label>
            <input type="date" name="release_date" class="form-control" value="{{ old('release_date') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Треклист (по одному треку на строку)</label>
            <textarea name="tracks" class="form-control" rows="4"
                      placeholder="Вступление - 2:15&#10;Militantum - 3:42">{{ old('tracks') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Обложка</label>
            <input type="file" name="cover_image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
</body>
</html>