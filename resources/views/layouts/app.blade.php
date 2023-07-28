<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="icon" href="{{ URL::asset('photoicon.png') }}" type="image/x-icon"/>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        *{
            box-sizing:border-box;
        }
        body{
            width:100%;
            padding-left:10px;
            padding-right:10px;
            min-height:680px;
        }
        footer{
            position:fixed;
            bottom:0;
            left:0;
            width:100%;
            padding:3px;
            background-color:lightgrey;   
        }
        header{
            position:fixed;
            top:0;
            width:100%;
            left:0;
            z-index: 1;
        }
        #hero{
            padding:2rem;
        }
        main{
            overflow:auto;
        }
        a{
            text-decoration:none;
        }
        box-icon{
            height:30px;
            width:30px;
            fill:gray;
        }
        #navbarDropdown>box-icon{
            margin-right:3px;
        }
        #searchBar{
            display:flex;
            width:40%;
            align-items:center;
        }
        #foreign, #local{
            margin-bottom:0px;
            margin-right:2px;
            margin-left:2px;
        }
    </style>
</head>
<body>
    <div id="app"> <!--where vue app is supposed to be mounted -->
    <div id="hero"></div>
        <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ URL::asset('photoicon.png') }}" height="50px" width="50px" />PhotoApp
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto" style="display: flex; justify-content:space-around; align-items:center; width:100%;">
                        <div class="form-inline my-2 my-lg-0" id="searchBar" style="display:none;">
                            <form method="" action="" id="localForm" style="display:none; width:100%">
                                {{ csrf_field() }}
                                <input class="form-control mr-sm-2" name=query style="margin-right:5px;" required type="search" placeholder="Search Local Database" value="{{request()->get('query')}}" aria-label="Search">
                                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                            <form method="post" action="{{route('search')}}" id="foreignForm" style="display:none; width:100%">
                                {{ csrf_field() }}
                                <input class="form-control mr-sm-2" name=foreignQuery style="margin-right:5px;" type="search" placeholder="Search Pixabay" value="{{request()->get('foreignQuery')}}" aria-label="Search">
                                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                        <li class="nav-item" style="cursor: pointer" >
                            <p id=local >Local Search</p>
                        </li>  
                        @guest
                           
                        @else
                            <li class="nav-item" style="cursor: pointer" >
                                <p id=foreign >Third Party Search</p>
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link" href="{{route('newpost')}}">New Post</a>
                            </li>
        
                        @endguest
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" style="display:flex; align-items:center" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <box-icon type='solid' name='user-circle'></box-icon>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile', ['id'=>Auth::User()->id]) }}">
                                        Profile
                                    </a>
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
        </nav></header>

        <main class=" my-4">
        
            @yield('content')
        </main>
        <div id="hero"></div>
        <footer class="d-flex flex-wrap justify-content-between align-items-center">
                <p class="col-md-4 mb-0 text-muted">© Olamilly 2023 </p>
                <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item"><a href="#" class="nav-link px-2"><box-icon type='logo' name='instagram'></box-icon></a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2"><box-icon type='logo' name='youtube'></box-icon></a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2"><box-icon name='linkedin-square' type='logo' ></box-icon></a></li>
                </ul>
            </footer>
            <script>
    // previous page should be reloaded when user navigate through browser navigation
    // for mozilla
    window.onunload = function(){};
    // for chrome
    if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
        location.reload();
    }

    document.getElementById("local").addEventListener("click",()=>{
        document.getElementById("searchBar").style.display="block";
        document.getElementById("localForm").style.display="flex";
        document.getElementById("foreignForm").style.display="none";
        document.getElementById("local").style.display="none";
        document.getElementById("foreign").style.display="block";
    })
    document.getElementById("foreign").addEventListener("click",()=>{
        document.getElementById("searchBar").style.display="block";
        document.getElementById("foreignForm").style.display="flex";
        document.getElementById("localForm").style.display="none";
        document.getElementById("foreign").style.display="none";
        document.getElementById("local").style.display="block";
    })
    </script>
    </div>
</body>
</html>
