<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portfolio</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==' crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header>

            <nav class="navbar navbar-expand-md bg-dark" data-bs-theme="dark">

                <div class="wrapper d-flex w-100 justify-content-between py-2 align-items-center px-2">

                    <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white"></span>
                    </button>
                
                    <a class="navbar-brand col-2 text-white d-block d-md-inline me-sm-3"
                        href="{{ route('admin.dashboard') }}">
                        Portfolio
                    </a>

                    <input class="form-control" type="search" placeholder="Search"
                        aria-label="Search">

                    <div class="dropdown-center">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white ms-2" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>

                            <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                        {{-- /.dropdown-menu --}}

                    </div>
                    {{-- /.dropdown-center --}}

                </div>
                {{-- /.wrapper --}}

            </nav>
            
        </header>

        <div class="container-fluid vh-100">
            <div class="row h-100">
                <!-- Definire solo parte del menu di navigazione inizialmente per poi
								aggiungere i link necessari giorno per giorno
								 -->
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark navbar-dark sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">

                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-secondary' : '' }}" href="{{route('admin.dashboard')}}">
                                    <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                                </a>

                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.projects.index' ? 'bg-secondary' : '' }}" href="{{route('admin.projects.index')}}">
                                    <i class="fa-solid fa-sheet-plastic fa-lg fa-fw"></i> Projects
                                    
                                </a>

                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.types.index' ? 'bg-secondary' : '' }}" href="{{route('admin.types.index')}}">
                                    <i class="fa-solid fa-font-awesome fa-lg fa-fw"></i> Types
                                    
                                </a>

                                <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.technologies.index' ? 'bg-secondary' : '' }}" href="{{route('admin.technologies.index')}}">
                                    <i class="fa-solid fa-laptop-code fa-lg fa-fw"></i> Technologies
                                </a>
                            </li>

                        </ul>


                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>

</html>
