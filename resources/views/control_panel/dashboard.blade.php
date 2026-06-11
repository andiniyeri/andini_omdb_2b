<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Movies Dashboard &mdash; Stisla</title>

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
    @include('layout.header')

            @include('layout.sidebar')

            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>{{__('messages.Movies')}}</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item">{{__('messages.Movies')}}</div>
                            <div class="breadcrumb-item">{{__('messages.All Movies')}}</div>
                        </div>
                    </div>

                    <div class="section-body">
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{__('messages.All Movies')}}</h4>
                                    </div>
                                    {{-- Search Form --}}
                            <form action="{{ route('movies.search') }}" method="GET" id="search-form">
                                <div class="float-right mb-3">
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            name="keyword"
                                            id="search-input"
                                            class="form-control"
                                            placeholder="{{ __('messages.search for movies') }}"
                                            value="{{ request('keyword') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                             {{-- Session Error --}}
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- API Error --}}
                            @if(isset($error) && $error)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Info hasil pencarian --}}
                            @if(request('keyword'))
                                <p class="text-muted mb-3">
                                    Hasil pencarian untuk: <strong>{{ request('keyword') }}</strong>
                                    @isset($total)
                                        &mdash; <strong>{{ $total }}</strong> film ditemukan
                                    @endisset
                                </p>
                            @endif

                                        <{{-- Table --}}
                            <div class="table-responsive">
                                <table class="table table-striped" id="movie-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('messages.Poster') }}</th>
                                            <th>{{ __('messages.Title') }}</th>
                                            <th>{{ __('messages.Year') }}</th>
                                            <th>{{ __('messages.Type') }}</th>
                                            <th>{{ __('messages.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Movie-container">
                                        @isset($movies)
                                            @forelse($movies as $movie)
                                                <tr>
                                                    <td class="align-middle">
                                                        <img
                                                            src="{{ isset($movie['Poster']) && $movie['Poster'] !== 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/50x70?text=No+Image' }}"
                                                            width="50"
                                                            height="70"
                                                            style="object-fit: cover; border-radius: 4px;"
                                                            alt="{{ $movie['Title'] ?? '' }}">
                                                    </td>
                                                    <td class="align-middle">{{ $movie['Title'] ?? '-' }}</td>
                                                    <td class="align-middle">{{ $movie['Year'] ?? '-' }}</td>
                                                    <td class="align-middle">
                                                        <span class="badge badge-primary">
                                                            {{ ucfirst($movie['Type'] ?? 'movie') }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <button
                                                            class="btn btn-sm btn-outline-danger mr-1 favorite-btn"
                                                            data-imdb="{{ $movie['imdbID'] ?? '' }}"
                                                            data-title="{{ $movie['Title'] ?? '' }}"
                                                            data-year="{{ $movie['Year'] ?? '' }}"
                                                            data-poster="{{ isset($movie['Poster']) && $movie['Poster'] !== 'N/A' ? $movie['Poster'] : '' }}"
                                                            data-type="{{ $movie['Type'] ?? '' }}"
                                                            type="button"
                                                        >
                                                            <i class="fas fa-heart"></i>
                                                        </button>
                                                        <a href="{{ route('movies.detail', $movie['imdbID']) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-5">
                                                        <i class="fas fa-film fa-3x text-muted mb-3 d-block"></i>
                                                        <span class="text-muted">
                                                            Film tidak ditemukan untuk "<strong>{{ request('keyword') }}</strong>"
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @else
                                            <tr id="empty-row">
                                                <td colspan="5" class="text-center py-5">
                                                    <i class="fas fa-search fa-3x text-muted mb-3 d-block"></i>
                                                    <span class="text-muted">{{ __('messages.enter keywords to search for movies') }}</span>
                                                </td>
                                            </tr>
                                        @endisset
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @isset($total)
                                @if($total > 10)
                                    @php
                                        $currentPage = (int) request('page', 1);
                                        $totalPages  = (int) ceil($total / 10);
                                    @endphp
                                    <div class="d-flex justify-content-center mt-4">
                                        <nav>
                                            <ul class="pagination">
                                                <li class="page-item {{ $currentPage <= 1 ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ route('movies.search', ['keyword' => request('keyword'), 'page' => $currentPage - 1]) }}">
                                                        &laquo;
                                                    </a>
                                                </li>
                                                @for($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++)
                                                    <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ route('movies.search', ['keyword' => request('keyword'), 'page' => $i]) }}">
                                                            {{ $i }}
                                                        </a>
                                                    </li>
                                                @endfor
                                                <li class="page-item {{ $currentPage >= $totalPages ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ route('movies.search', ['keyword' => request('keyword'), 'page' => $currentPage + 1]) }}">
                                                        &raquo;
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                @endif
                            @endisset

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

            @include('layout.footer')

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
    <script>
        // Set current year in footer
        document.getElementById('years').textContent = new Date().getFullYear();

        const favoriteButtons = document.querySelectorAll('.favorite-btn');
        if (favoriteButtons.length) {
            const csrfToken = '{{ csrf_token() }}';
            const storeUrl = '{{ route('favorites.store') }}';

            favoriteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const payload = {
                        imdb_id: this.dataset.imdb,
                        title: this.dataset.title,
                        year: this.dataset.year,
                        poster: this.dataset.poster,
                        type: this.dataset.type,
                    };

                    fetch(storeUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(payload),
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.remove('btn-outline-danger');
                            this.classList.add('btn-danger');
                            this.innerHTML = '<i class="fas fa-heart"></i> Added';
                        } else {
                            alert(data.message || 'Terjadi kesalahan.');
                        }
                    })
                    .catch(() => alert('Terjadi kesalahan.'));
                });
            });
        }
    </script>

</body>

</html>