<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="icon" href="{{ asset('img/logo.png') }}">
	<meta name="description" content="{{ config('app.name', 'Laravel') }} - app de delivery">
	<meta name="theme-color" content="#FFFFFF" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- PWA Manifest -->
	<link rel="manifest" href="{{ asset('manifest.json') }}">

	<!-- iOS meta tags and icons -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'Laravel') }}">
	<link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">

	<!-- Service Worker -->
	<script>
		// Register service worker.
		if ('serviceWorker' in navigator) {
		window.addEventListener('load', () => {
			navigator.serviceWorker.register('{{ asset('/service-worker.js') }}')
				.then((reg) => {
				console.log('Service worker registered.', reg);
				});
		});
		}
	</script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
    <style>
    @media only screen and (max-width : 576px)
    {
        .mobile-card-container > .row {
            overflow-x: auto;
        }
    }
    </style>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-faded px-5">

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Menu') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-justified w-100">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Loja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/carrinho') }}">Carrinho</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/pedidos') }}">Pedidos</a>
                </li>
                <!-- Links de autenticação! -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/cliente">
                                Minha Conta
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
                                {{ __('Sair') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
       </div>
       <a class="navbar-brand" href="#">
            <img src="{{url('img/') . '/logo.png'}}" width="30" height="30" class="d-inline-block align-top" alt="Logo">
       </a>
       <a href="{{ url('/carrinho') }}">			
				<i class="fas fa-shopping-cart"></i>				
		</a>
    </nav>

    <!-- SEÇÃO COM PESQUISA E CATEGORIAS -->
    <div id="mascarasecao"></div>
    <section class="secao2">        
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Pesquise por produtos" aria-label="Pesquisar">
            <i style="position: absolute; margin-left: 93%;" class="fas fa-search right"></i>
        </form>
        <div class="container-fluid mobile-card-container cardajust">
            <h1 class="text-center">Categorias</h1>
			<div class="row text-center flex-nowrap flex-sm-wrap">
			@foreach ($categorias as $c)
				<form method="POST" action="/buscar" id="buscar-{{$c->codigoCategoria}}" name="buscar-{{$c->codigoCategoria}}">
				@csrf
				<input type="hidden" name="codigoCategoria" id="codigoCategoria" value="{{$c->codigoCategoria}}">
					<div class="p-2">
						<div class="cardcat" onClick="document.forms['buscar-{{$c->codigoCategoria}}'].submit();">
							<div class="card-body">
								<div class="row justify-content-center">
									@if ($filtrado == $c->codigoCategoria)
										<b>{{$c->nome}}</b>
									@else
										{{$c->nome}}	
									@endif
								</div>
							</div>
						</div>
					</div>
				</form>
			@endforeach
        </div>
    </section>

    <!-- SEÇÃO COM CATEGORIAS, AO IMPLEMENTAR UMA MODELAGEM DO BANCO SERÁ FEITO UM FOREACH -->
    <section class="secao3">        
        <div class="container-fluid">
            
            
            

        </div>
    </section>
    





    <main class="py-4">
        @yield('content')
    </main>

</div>
</body>
</html>
