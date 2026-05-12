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
                                    <div class="card-body">
                                        <div class="float-right">
                                            <form method="GET" action="" id="search-form">
                                                <div class="input-group">
                                                    <input type="text" name="q" id="search-input"
                                                        class="form-control" placeholder="Search movies..."
                                                        value="{{ request('q') }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="clearfix mb-3"></div>
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="movie-table">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('messages.Poster')}}</th>
                                                        <th>{{__('messages.Title')}}</th>
                                                        <th>{{__('messages.Year')}}</th>
                                                        <th>{{__('messages.Type')}}</th>
                                                        <th>{{__('messages.Action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="movie-container">
                                                    <tr id="empty-row">
                                                        <td colspan="5" class="text-center py-5">
                                                            <i class="fas fa-search fa-3x text-muted mb-3 d-block"></i>
                                                            <span class="text-muted">{{__('messages.Enter a keyword to search movies.')}}</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div id="loader" class="text-center py-3" style="display: none;">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <p class="text-muted mt-2">Loading more movies...</p>
                                        </div>
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
    </script>

</body>

</html>