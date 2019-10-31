<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ChurchAdmin') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.2.0/css/uikit.min.css" />
    
</head>
<body style="font-family: 'Montserrat', sans-serif;">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
                <a class="navbar-brand uk-margin-small-right nav-link" uk-toggle="target: #offcanvas-nav" href="{{ url('/') }}">
                    <span class="uk-margin-small-right" uk-icon="icon: table"></span>
                    {{ config('app.name', 'ChurchAdmin') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: relative; padding-left: 50px;" v-pre>
                                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 32px; height:32px; position: absolute; top: 10px; left: 10px; border-radius: 45%">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href={{ url('/profile') }}>Edit Profile</a> --}}
                                    <a class="dropdown-item" href="/notifications"><span class="uk-margin-small-right" uk-icon="icon: bell"></span> Notifications <span class="badge badge-pill badge-dark" >{{ count(auth()->user()->unreadNotifications) }}</span></a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> 
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            
        </nav>

        <div id="offcanvas-nav" uk-offcanvas="overlay: true">
            <div class="uk-offcanvas-bar">
        
                <ul class="uk-nav uk-nav-default">
                    {{-- <li class="uk-active"><a href="#">Active</a></li> --}}
                    
                    {{-- <li class="uk-nav-header">Header</li> --}}
                    <li><a href="/home"><span class="uk-margin-small-right" uk-icon="icon: home"></span> Dashboard</a></li>
                    <br>
                    <li class="uk-nav-divider"></li>
                    <br>
                    <li><a href="/members"><span class="uk-margin-small-right" uk-icon="icon: users"></span> Members Directory</a></li>
                    <br>
                    {{-- <li><a href="/members"><span class="uk-margin-small-right" uk-icon="icon: users"></span> Church Directory</a></li>
                    <br> --}}
                    <li class="uk-nav-divider"></li>
                    <br>
                    <li><a href="/sermons"><span class="uk-margin-small-right" uk-icon="icon: bookmark"></span> Bible Notes</a></li>
                    
                    <li><a href="/services"><span class="uk-margin-small-right" uk-icon="icon: tag"></span> Church Services</a></li>
                    <li><a href="/conferences"><span class="uk-margin-small-right" uk-icon="icon: calendar"></span> Events &amp; Conferences</a></li>
                    <li><a href="/roles"><span class="uk-margin-small-right" uk-icon="icon: user"></span> Roles</a></li>
                    <li><a href="/departments"><span class="uk-margin-small-right" uk-icon="icon: copy"></span> Departments</a></li>
                    <br>
                    <li class="uk-nav-divider"></li>
                    <br>
                    {{-- <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: album"></span> Finance</a></li> --}}
                    <li class="uk-parent">
                        <a href="#"><span class="uk-margin-small-right" uk-icon="icon: album"></span> Finance</a>
                        <ul class="uk-nav-sub">
                            <li><a href="/expense"><span class="uk-margin-small-right" uk-icon="icon: push"></span> Expenses</a></li>
                            <li><a href="/income"><span class="uk-margin-small-right" uk-icon="icon: pull"></span> Income</a></li>
                            {{-- <li><a href="/services/create">Create Service</a></li>
                            <li><a href="/conferences/create">Create Event</a></li>
                            <li><a href="/rotas/create">Create Duty Rota</a></li> --}}
                        </ul>
                    </li>
                    <br>
                    <li class="uk-nav-divider"></li>
                    <br>
                    <li><a href="/insights"><span class="uk-margin-small-right" uk-icon="icon: print"></span> Reports &amp; Insights</a></li>
                    <br>
                </ul>
        
            </div>
        </div>

        <main class="py-4">
            {{-- <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" 
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">Dashboard <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/sermons">Bible Notes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/conferences">Events &amp; Conferences</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/roles">Church Roles</a>
                        </li>
                        </ul>
                    </div>
                </nav>
            </div> --}}
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
    
    @yield('javascripsts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.2.0/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.2.0/js/uikit-icons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">
    </script>
    {{-- <script>
            $(document).ready(function(){
                $('#search_text').keyup(function(){
                    var txt = $(this).val();
                    if(txt != '')
                    {
                        $.ajax({
                            url:"fetch.php",
                            method:"post",
                            data:{search:txt},
                            dataType:"text",
                            success:function(data)
                            {
                                $('#result').html(data);
                            }
                        });
                    }
                    else
                    {
                        $('#result').html('');
                        $.ajax({
                            url:"fetch.php",
                            method:"post",
                            data:{search:txt},
                            dataType:"text",
                            success:function(data)
                            {
                                $('#result').html(data);
                            }
                        });
                    }
                });
            });
        </script> --}}
</body>
</html>