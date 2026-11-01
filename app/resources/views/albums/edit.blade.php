<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Редактировать альбом</title>
    @vite(['resources/scss/styles.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Редактировать: {{ $album->title }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('albums.update', $album) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Название альбома</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title', $album->title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Исполнитель</label>
            <input type="text" name="artist" class="form-control" required value="{{ old('artist', $album->artist) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Тип (метка)</label>
            <input type="text" name="label" class="form-control" required value="{{ old('label', $album->label) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <textarea name="full_description" class="form-control" rows="4">{{ old('full_description', $album->full_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Дата релиза</label>
            <input type="date" name="release_date" class="form-control"
                   value="{{ old('release_date', $album->release_date?->format('Y-m-d')) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Треклист</label>
            <textarea name="tracks" class="form-control" rows="4">{{ old('tracks', $album->tracks) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Обложка (заменить)</label>
            <input type="file" name="cover_image" class="form-control" accept="image/*">
            @if($album->cover_image)
                <img src="{{ Storage::url($album->cover_image) }}" alt="" class="mt-2" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
</body>
</html>