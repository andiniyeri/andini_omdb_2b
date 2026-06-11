<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>My Favorites &mdash; Stisla</title>

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
                        <h1>{{__('messages.My Favorites')}}</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                            <div class="breadcrumb-item">Favorites</div>
                        </div>
                    </div>

                    <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('messages.Favorite Movies') }}</h4>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('messages.Poster') }}</th>
                                            <th>{{ __('messages.Title') }}</th>
                                            <th>{{ __('messages.Year') }}</th>
                                            <th>{{ __('messages.Type') }}</th>
                                            <th>{{ __('messages.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="favorites-tbody">
                                        @forelse($favorites as $favorite)
                                            <tr id="row-{{ $favorite->imdb_id }}">
                                                <td class="align-middle">
                                                    <img
                                                        src="{{ $favorite->poster && $favorite->poster !== 'N/A' ? $favorite->poster : 'https://via.placeholder.com/50x70?text=No+Image' }}"
                                                        width="50"
                                                        height="70"
                                                        style="object-fit: cover; border-radius: 4px;"
                                                        alt="{{ $favorite->title }}">
                                                </td>
                                                <td class="align-middle">{{ $favorite->title }}</td>
                                                <td class="align-middle">{{ $favorite->year }}</td>
                                                <td class="align-middle">
                                                    <span class="badge badge-primary">
                                                        {{ ucfirst($favorite->type) }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('movies.detail', $favorite->imdb_id) }}"
                                                       class="btn btn-sm btn-info mr-1">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    <button class="btn btn-sm btn-danger remove-favorite"
                                                            data-imdb="{{ $favorite->imdb_id }}"
                                                            data-url="{{ route('favorites.destroy', $favorite->imdb_id) }}"
                                                            type="button">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr id="empty-state">
                                                <td colspan="5">
                                                    <div class="text-center py-5">
                                                        <i class="fas fa-heart-broken fa-3x text-muted mb-3 d-block"></i>
                                                        <h5 class="text-muted">{{ __('messages.No favorites yet') }}</h5>
                                                        <p class="text-muted">{{ __('messages.Start adding movies to your favorites list!') }}</p>
                                                        <a href="{{ route('movies.search') }}" class="btn btn-primary mt-2">
                                                            <i class="fas fa-search"></i> {{ __('messages.find your favorite movie') }}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- SweetAlert Notifications --}}
@if(session()->has('success'))
  <script>
    swal({
        title: "{{ session()->get('success') }}",
        icon: 'success',
        buttons: false,
        timer: 3000,
    });
  </script>
@endif

@if(session()->has('error'))
  <script>
    swal({
        title: "{{ session()->get('error') }}",
        icon: 'error',
        buttons: false,
        timer: 3000,
    });
  </script>
@endif

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
    <script src="{{ asset('assets/modules/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        document.querySelectorAll('.remove-favorite').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const imdbId = this.dataset.imdb;
                const row    = document.getElementById(`row-${imdbId}`);
                const tbody  = document.getElementById('favorites-tbody');
                const deleteUrl = this.dataset.url;

                swal({
                    title: 'Hapus dari Favorites?',
                    text: 'Film ini akan dihapus dari daftar favorites kamu.',
                    icon: 'warning',
                    buttons: {
                        cancel: 'Batal',
                        confirm: 'Ya, Hapus!',
                    },
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
                                row.remove();

                                if (tbody.querySelectorAll('tr').length === 0) {
                                    tbody.innerHTML = `
                                        <tr id="empty-state">
                                            <td colspan="5">
                                                <div class="text-center py-5">
                                                    <i class="fas fa-heart-broken fa-3x text-muted mb-3 d-block"></i>
                                                    <h5 class="text-muted">No favorites yet</h5>
                                                    <p class="text-muted">Start adding movies to your favorites list!</p>
                                                    <a href="{{ route('movies.search') }}" class="btn btn-primary mt-2">
                                                        <i class="fas fa-search"></i> Find your favorite movie
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    `;
                                }

                                swal({
                                    title: data.message,
                                    icon: 'success',
                                    buttons: false,
                                    timer: 3000,
                                });
                            } else {
                                swal({
                                    title: data.message,
                                    icon: 'error',
                                    buttons: false,
                                    timer: 3000,
                                });
                            }
                        })
                        .catch(() => {
                            swal({
                                title: 'Terjadi kesalahan.',
                                icon: 'error',
                                buttons: false,
                                timer: 3000,
                            });
                        });
                    }
                });
            });
        });
    </script>
    <script>
        // Set current year in footer
        document.getElementById('years').textContent = new Date().getFullYear();
    </script>
</body>

</html>