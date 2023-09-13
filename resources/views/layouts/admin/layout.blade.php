<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Content Scheduler') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- site icon -->
    <link rel="icon" href="{{ asset('import/images/fevicon.png') }}" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('import/css/bootstrap.min.css') }}" />
    <!-- site css -->
    <link rel="stylesheet" href="{{ asset('import/css/style.css') }}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('import/css/responsive.css') }}" />
    <!-- color css -->
    <link rel="stylesheet" href="{{ asset('import/css/colors.css') }}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{ asset('import/css/bootstrap-select.css') }}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{ asset('import/css/perfect-scrollbar.css') }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('import/css/custom.css') }}" />
    <!-- Font Awesome -->
    
    <link rel="stylesheet" href="{{ asset('import/css/font-awesome.min.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" /> --}}
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
{{-- <body> --}}
    {{-- <div id="app"> --}}
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Content Scheduler') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
        <body class="dashboard dashboard_1">
            <div class="full_container">
               <div class="inner_container">
                    <!-- Sidebar  -->
                    @include('layouts.admin.sidebar')
                    <!-- end sidebar -->
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>

            <!-- jQuery -->
      
            <script src="{{ asset('import/js/jquery.min.js') }}"></script>
            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
            <script src="{{ asset('import/js/popper.min.js') }}"></script>
            <script src="{{ asset('import/js/bootstrap.min.js') }}"></script>
            <!-- wow animation -->
            <script src="{{ asset('import/js/animate.js') }}"></script>
            <!-- select country -->
            <script src="{{ asset('import/js/bootstrap-select.js')}}"></script>
            <!-- owl carousel -->
            <script src="{{ asset('import/js/owl.carousel.js')}}"></script> 
            <!-- chart js -->
            <script src="{{ asset('import/js/Chart.min.js') }}"></script>
            <script src="{{ asset('import/js/Chart.bundle.min.js') }}"></script>
            <script src="{{ asset('import/js/utils.js') }}"></script>
            <script src="{{ asset('import/js/analyser.js') }}"></script>
            <!-- nice scrollbar -->
            <script src="{{ asset('import/js/perfect-scrollbar.min.js') }}"></script>
            <script>
                var ps = new PerfectScrollbar('#sidebar');
            </script>
            <!-- custom js -->
            <script src="{{ asset('import/js/custom.js') }}"></script>
            <script src="{{ asset('import/js/chart_custom_style1.js') }}"></script>
            
            {{-- Add wallet Script --}}

            @yield('scripts');


        </body>
    {{-- </div> --}}
{{-- </body> --}}
</html>
