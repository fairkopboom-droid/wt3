<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>{{ $album->title }}</title>
    @vite(['resources/scss/styles.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container my-5">
    <a href="{{ route('albums.index') }}" class="btn btn-secondary mb-3">← Назад</a>

    <div class="card album-card">
        <div class="row g-0">
            <div class="col-md-4">
            @if($album->cover_image)
                <img src="{{ Str::startsWith($album->cover_image, 'http') ? $album->cover_image : Storage::url($album->cover_image) }}" class="img-fluid rounded-start" alt="{{ $album->title }}">
            @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ $album->title }}</h1>
                    <p class="artist">{{ $album->artist }}</p>
                    <p><strong>{{ $album->label }}</strong></p>

                    @if($album->release_date)
                        <p><strong>Дата релиза:</strong> {{ $album->release_date->format('d.m.Y') }}</p>
                    @endif

                    <p>{{ $album->full_description }}</p>

                    @if($album->tracks_array)
                        <h5>Треки:</h5>
                        <ul class="tracklist">
                            @foreach($album->tracks_array as $track)
                                <li>{{ $track }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ route('albums.edit', $album) }}" class="btn btn-primary mt-3">Редактировать</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>