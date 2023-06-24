<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{ 
            background-image: url('./images/fundo1.jpg');
            
        }
        nav#cabecalho{
        font-weight: bolder;
        }
        nav#cabecalho a:hover{
            color: blue;
        }
    </style>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: rgba(218, 218, 218, .8);" id="cabecalho">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav">
                    <img src="{{URL('/images/logoBarra.png') }}" alt="">
                </ul>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <!--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>-->
                                    <li><a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                    <li><a class="nav-link" href="{{ route('quem-somos') }}">{{ __('Quem somos') }}</a></li>
                                    <li><a class="nav-link" href="{{ route('multimidia') }}">{{ __('Multimídia') }}</a></li>
                                    <li><a class="nav-link" href="{{ route('localizacao') }}">{{ __('Localização') }}</a></li>
                                    <!--<li><a class="nav-link" href="{{ route('fale-conosco') }}">{{ __('Fale conosco') }}</a></li>-->
                                </li>
                            @endif
                        @else

                        <div>
                            <b-navbar>
                                <b-navbar-nav class="navbar navbar-expand-md navbar-light">
                            
                                    <b-nav-item-dropdown text="Cadastrar">
                                        <b-dropdown-item>
                                            <a class="dropdown-item" href="{{ route('cadastro-cliente') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('cadastro-cliente-form').submit();">
                                                Cliente
                                            </a>
                                            <form id="cadastro-cliente-form" action="{{ route('cadastro-cliente') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </b-dropdown-item>

                                        <b-dropdown-item>
                                            <a class="dropdown-item" href="{{ route('cadastro-funcionario') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('cadastro-funcionario-form').submit();">
                                                Funcionário
                                            </a>
                                            <form id="cadastro-funcionario-form" action="{{ route('cadastro-funcionario') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </b-dropdown-item>

                                        <b-dropdown-item>
                                            <a class="dropdown-item" href="{{ route('consultar-cadastro') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('consultar-cadastro-form').submit();">
                                                Consultar cadastros
                                            </a>
                                            <form id="consultar-cadastro-form" action="{{ route('consultar-cadastro') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </b-dropdown-item>
                                    </b-nav-item-dropdown>


                                    <b-nav-item-dropdown text="Estoque">
                                        <b-dropdown-item>
                                            <a class="dropdown-item" href="{{ route('estoque') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('estoque-form').submit();">
                                                Consultar Estoque
                                            </a>
                                            <form id="estoque-form" action="{{ route('estoque') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </b-dropdown-item>
                                        
                                        <b-dropdown-item>
                                            <a class="dropdown-item" href="{{ route('adicionar-produto') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('adicionar-produto-form').submit();">
                                                Adicionar produto
                                            </a>
                                            <form id="adicionar-produto-form" action="{{ route('adicionar-produto') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </b-dropdown-item>
                                    </b-nav-item-dropdown>

                                    
                                    <b-nav-item-dropdown text="User">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </b-nav-item-dropdown>
                                </b-navbar-nav>
                            </b-navbar>
                        </div>
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>
</html>
