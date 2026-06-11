<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Movie Detail &mdash; Stisla</title>

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    @include('layout.header')
    @include('layout.sidebar')

    <div class="main-content">
                            <section class="section">
                                <div class="section-header">
                                    <h1>{{ __('Movie Detail') }}</h1>
                                    <div class="section-header-breadcrumb">
                                        <div class="breadcrumb-item active">
                                            <a href="{{ route('dashboard') }}">Dashboard</a>
                                        </div>
                                        <div class="breadcrumb-item">
                                            <a href="{{ route('movies.search') }}">Movies</a>
                                        </div>
                                        <div class="breadcrumb-item">Movie Detail</div>
                                    </div>
                                </div>

                                <div class="section-body">
                                    <div class="row">

                                        {{-- Poster --}}
                                        <div class="col-12 col-md-4">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <img
                                                        src="{{ isset($movie['Poster']) && $movie['Poster'] !== 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450?text=No+Image' }}"
                                                        alt="{{ $movie['Title'] ?? 'Movie' }}"
                                                        class="img-fluid rounded"
                                                        loading="lazy">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Detail --}}
                                        <div class="col-12 col-md-8">
                                            <div class="card">
                                                <div class="card-body">

                                                    {{-- Cek apakah sudah di favorite --}}
                                                    @php
                                                        $isFavorite = \App\Models\Favorite::where('user_id', auth()->id())
                                                                        ->where('imdb_id', $movie['imdbID'])
                                                                        ->exists();
                                                    @endphp

                                                    {{-- Title & Favorite Button --}}
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h2 class="mb-1">{{ $movie['Title'] ?? '-' }}</h2>
                                                            <p class="text-muted mb-3">
                                                                {{ $movie['Year'] ?? '-' }} &bull;
                                                                {{ $movie['Runtime'] ?? '-' }} &bull;
                                                                {{ $movie['Genre'] ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <button type="button"
                                                            class="btn {{ $isFavorite ? 'btn-danger' : 'btn-outline-danger' }}"
                                                            id="favorite-btn"
                                                            data-imdb="{{ $movie['imdbID'] ?? '' }}"
                                                            data-destroy-url="{{ route('favorites.destroy', $movie['imdbID'] ?? '') }}"
                                                            data-title="{{ $movie['Title'] ?? '' }}"
                                                            data-year="{{ $movie['Year'] ?? '' }}"
                                                            data-poster="{{ $movie['Poster'] ?? '' }}"
                                                            data-type="{{ $movie['Type'] ?? 'movie' }}">
                                                            <i class="{{ $isFavorite ? 'fas' : 'far' }} fa-heart"></i>
                                                            <span>{{ $isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}</span>
                                                        </button>
                                                    </div>

                                                    {{-- Ratings --}}
                                                    <div class="mb-4">
                                                        @if(isset($movie['imdbRating']) && $movie['imdbRating'] !== 'N/A')
                                                            <span class="badge badge-info mr-1">
                                                                IMDb: {{ $movie['imdbRating'] }}/10
                                                            </span>
                                                        @endif
                                                        @if(isset($movie['Ratings'][1]))
                                                            <span class="badge badge-info mr-1">
                                                                Rotten Tomatoes: {{ $movie['Ratings'][1]['Value'] }}
                                                            </span>
                                                        @endif
                                                        @if(isset($movie['Metascore']) && $movie['Metascore'] !== 'N/A')
                                                            <span class="badge badge-info mr-1">
                                                                Metacritic: {{ $movie['Metascore'] }}/100
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Plot --}}
                                                    <h5>Plot</h5>
                                                    <p class="mb-4">{{ $movie['Plot'] ?? '-' }}</p>

                                                    {{-- Director & Writer --}}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h6>Director</h6>
                                                            <p>{{ $movie['Director'] ?? '-' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>Writer</h6>
                                                            <p>{{ $movie['Writer'] ?? '-' }}</p>
                                                        </div>
                                                    </div>

                                                    {{-- Actors & Language --}}
                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <h6>Actors</h6>
                                                            <p>{{ $movie['Actors'] ?? '-' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>Language</h6>
                                                            <p>{{ $movie['Language'] ?? '-' }}</p>
                                                        </div>
                                                    </div>

                                                    {{-- Country & Box Office --}}
                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <h6>Country</h6>
                                                            <p>{{ $movie['Country'] ?? '-' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>Box Office</h6>
                                                            <p>{{ isset($movie['BoxOffice']) && $movie['BoxOffice'] !== 'N/A' ? $movie['BoxOffice'] : '-' }}</p>
                                                        </div>
                                                    </div>

                                                    {{-- Back Button --}}
                                                    <div class="mt-4">
                                                        <a href="{{ route('movies.search') }}" class="btn btn-secondary">
                                                            <i class="fas fa-arrow-left"></i> Back to Movies
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>

                        

                            <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
                            <script src="{{ asset('assets/modules/popper.js') }}"></script>
                            <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
                            <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
                            <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
                            <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
                            <script src="{{ asset('assets/js/stisla.js') }}"></script>

                            <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
                            <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
                            <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

                            <script src="{{ asset('assets/js/scripts.js') }}"></script>
                            <script src="{{ asset('assets/js/custom.js') }}"></script>
    @include('layout.footer')
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const yearsElement = document.getElementById('years');
                                    if (yearsElement) {
                                        yearsElement.textContent = new Date().getFullYear();
                                    }

                                    const favoriteBtn = document.getElementById('favorite-btn');
                                    if (!favoriteBtn) {
                                        return;
                                    }

                                    const csrfToken = '{{ csrf_token() }}';
                                    const storeUrl = '{{ route('favorites.store') }}';
                                    const deleteUrl = favoriteBtn.dataset.destroyUrl;

                                    favoriteBtn.addEventListener('click', function () {
                                        const isFavorite = favoriteBtn.classList.contains('btn-danger');
                                        const payload = {
                                            imdb_id: favoriteBtn.dataset.imdb,
                                            title: favoriteBtn.dataset.title,
                                            year: favoriteBtn.dataset.year,
                                            poster: favoriteBtn.dataset.poster,
                                            type: favoriteBtn.dataset.type,
                                        };

                                        if (isFavorite) {
                                            fetch(deleteUrl, {
                                                method: 'DELETE',
                                                headers: {
                                                    'X-CSRF-TOKEN': csrfToken,
                                                    'X-Requested-With': 'XMLHttpRequest',
                                                    'Accept': 'application/json',
                                                },
                                            })
                                            .then(res => {
                                                if (!res.ok) {
                                                    throw new Error('HTTP ' + res.status);
                                                }
                                                return res.json();
                                            })
                                            .then(data => {
                                                if (data.success) {
                                                    favoriteBtn.classList.remove('btn-danger');
                                                    favoriteBtn.classList.add('btn-outline-danger');
                                                    favoriteBtn.innerHTML = '<i class="far fa-heart"></i> <span>Add to Favorites</span>';
                                                } else {
                                                    alert(data.message || 'Terjadi kesalahan.');
                                                }
                                            })
                                            .catch(() => alert('Terjadi kesalahan.'));
                                        } else {
                                            fetch(storeUrl, {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': csrfToken,
                                                    'X-Requested-With': 'XMLHttpRequest',
                                                    'Content-Type': 'application/json',
                                                    'Accept': 'application/json',
                                                },
                                                body: JSON.stringify(payload),
                                            })
                                            .then(res => {
                                                if (!res.ok) {
                                                    throw new Error('HTTP ' + res.status);
                                                }
                                                return res.json();
                                            })
                                            .then(data => {
                                                if (data.success) {
                                                    favoriteBtn.classList.remove('btn-outline-danger');
                                                    favoriteBtn.classList.add('btn-danger');
                                                    favoriteBtn.innerHTML = '<i class="fas fa-heart"></i> <span>Remove from Favorites</span>';
                                                } else {
                                                    alert(data.message || 'Terjadi kesalahan.');
                                                }
                                            })
                                            .catch(() => alert('Terjadi kesalahan.'));
                                        }
                                    });
                                });
                            </script>
</body>

</html>