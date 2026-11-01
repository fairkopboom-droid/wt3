<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Музыкальные альбомы</title>
    @vite(['resources/scss/styles.scss', 'resources/js/app.js'])
</head>
<body>
    
<script>
    window.albumsData = @json($albums->items());
</script>

<nav class="navbar navbar-expand-lg navbar-albums">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('albums.index') }}">
            <span class="logo-badge">♪</span>
            <span>Альбомы</span>
        </a>
        <div class="ms-auto">
            <a href="{{ route('albums.create') }}" class="btn btn-load">Добавить</a>
        </div>
    </div>
</nav>

<div class="container my-4 my-md-5">
    <h1 class="text-center mb-2">Популярные альбомы лета 2026</h1>
    <p class="text-center text-secondary mb-0">Нажмите «Подробнее», чтобы открыть информацию об альбоме</p>
</div>

<main class="container mb-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @forelse($albums as $i => $album)
            @php $tone = ($i % 5) + 1; @endphp
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-3 col-xxxl-3">
                <div class="card album-card card-tone-{{ $tone }} h-100">
                    <span class="label">{{ $album->label }}</span>

                    @if($album->cover_image)
                    <div class="card-img-wrapper">
                        <img src="{{ Str::startsWith($album->cover_image, 'http') ? $album->cover_image : Storage::url($album->cover_image) }}" class="card-img-top" alt="{{ $album->title }}">
                    </div>
                    @endif

                    <div class="card-body d-flex flex-column pt-5">
                        <h5 class="card-title">{{ $album->title }}</h5>
                        <p class="artist mb-2">{{ $album->artist }}</p>

                        <div class="mt-auto d-flex gap-2 flex-wrap">
                            <button class="btn btn-primary btn-sm open-modal-btn" data-index="{{ $loop->index }}">Подробнее</button>
                            
                            <a href="{{ route('albums.edit', $album) }}" class="btn btn-secondary btn-sm">Редактировать</a>
                            <form action="{{ route('albums.destroy', $album) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Удалить альбом?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Пока нет ни одного альбома. Нажмите «Добавить».</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $albums->links() }}
    </div>
</main>

<footer class="site-footer">
    <div class="container py-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <span>Егоренко Данил Олегович</span>
        <div>
            <a href="#" class="social">in</a>
            <a href="#" class="social">f</a>
            <a href="#" class="social">t</a>
        </div>
    </div>
</footer>

<div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Альбом</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-12 col-md-5">
                        <img id="modalImg" src="" alt="" class="img-fluid rounded w-100">
                    </div>
                    <div class="col-12 col-md-7">
                        <p id="modalText" class="mb-3"></p>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="prevBtn">← Пред</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="nextBtn">След →</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <small class="text-secondary me-auto">
                    Используйте стрелки влево и вправо или кнопки для переключения
                </small>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>