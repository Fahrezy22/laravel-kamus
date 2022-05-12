<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>KAMUS TRANSLATE</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('template/node_modules/summernote/dist/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('template/node_modules/codemirror/lib/codemirror.css')}}">
    <link rel="stylesheet" href="{{asset('template/node_modules/codemirror/theme/duotone-dark.css')}}">
    <link rel="stylesheet" href="{{asset('template/node_modules/selectric/public/selectric.css')}}">
    <link rel="stylesheet" href="{{asset('template/node_modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/node_modules/izitoast/dist/css/iziToast.min.css')}}">
    @yield('css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('template/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/css/components.css')}}">
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="index.html" class="navbar-brand sidebar-gone-hide">KT Bahasa Kaili</a>
                <div class="navbar-nav">
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                </div>
                <div class="nav-collapse">
                    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                </div>
                <form class="form-inline ml-auto">
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('template/assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Session::get('name') }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ (request()->RouteIS('translate')) ? 'active' : '' }}">
                          <a href="{{route('translate')}}" class="nav-link"><i class="far fa-clone"></i><span>Indonesia - Kaili</span></a>
                        </li>
                        <li class="nav-item {{ (request()->RouteIs('translate2')) ? 'active' : '' }}">
                            <a href="{{route('translate2')}}" class="nav-link"><i class="far fa-clone"></i><span>Kaili - Indonesia</span></a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('headtittle')</h1>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title">@yield('explaintitle')</h2>
                        <p class="section-lead">@yield('explain')</p>
                        @yield('content')
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div> Design By <a href="https://web.facebook.com/kuro.chan.58958343/">Ahd
                        Tola</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{asset('template/assets/js/stisla.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset('template/node_modules/summernote/dist/summernote-bs4.js')}}"></script>
    <script src="{{asset('template/node_modules/codemirror/lib/codemirror.js')}}"></script>
    <script src="{{asset('template/node_modules/codemirror/mode/javascript/javascript.js')}}"></script>
    <script src="{{asset('template/node_modules/selectric/public/jquery.selectric.min.js')}}"></script>
    <script src="{{asset('template/node_modules/simpleweather/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{asset('template/node_modules/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('template/node_modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('template/node_modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('template/node_modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
    <script src="{{asset('template/node_modules/izitoast/dist/js/iziToast.min.js')}}"></script>
    <script src="{{asset('template/node_modules/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- Page Specific JS File -->
    @yield('js')
    <!-- Template JS File -->
    <script src="{{asset('template/assets/js/scripts.js')}}"></script>
    <script src="{{asset('template/assets/js/custom.js')}}"></script>
</body>

</html>