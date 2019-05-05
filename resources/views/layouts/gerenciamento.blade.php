<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
<div id="app">
	@auth('funcionarioWeb')
    <nav class="navbar navbar-expand-md navbar-light bg-faded px-5">

        <a class="navbar-brand" href="#">
            <img src="{{url('img/') . '/logo.png'}}" width="30" height="30" class="d-inline-block align-top" alt="">
            {{ config('app.name', 'Laravel') }}
        </a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Menu') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-justified w-100">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Pedidos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ url('/gerenciamento/pedido') }}">Abertos</a>
						<a class="dropdown-item" href="{{ url('/gerenciamento/pedido/enviados') }}">Enviados</a>
						<a class="dropdown-item" href="{{ url('/gerenciamento/pedido/entregues') }}">Entregues</a>
						<a class="dropdown-item" href="{{ url('/gerenciamento/pedido/cancelados') }}">Cancelados</a>
					</div>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/gerenciamento/produto') }}">Produtos</a>
				</li>
				<li class="nav-item">
                    <a class="nav-link" href="{{ url('/gerenciamento/categoria') }}">Categorias</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/gerenciamento/funcionario') }}">Funcionários</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/gerenciamento/bairro') }}">Bairros</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/gerenciamento/cidade') }}">Cidades</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/gerenciamento/cliente') }}">Clientes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/gerenciamento/estabelecimento') }}">Estabelecimento</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('logout') }}"
						onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
						{{ __('Sair') }}
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</li>
            </ul>
        </div>
	</nav>
	@endauth

    <main class="py-4">
        @yield('content')
    </main>

</div>
</body>
</html>
