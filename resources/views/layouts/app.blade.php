<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="icon" href="{{ asset('img/logo.png') }}">
	<meta name="description" content="{{ config('app.name', 'SGSE') }}">
	<meta name="theme-color" content="#FFFFFF" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- PWA Manifest -->
	<link rel="manifest" href="{{ asset('manifest.json') }}">

	<!-- iOS meta tags and icons -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'SGSE') }}">
	<link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">

	<!-- Service Worker e Notificação -->
	<script>
        function urlBase64ToUint8Array(base64String) {
            var padding = '='.repeat((4 - base64String.length % 4) % 4);
            var base64 = (base64String + padding)
                .replace(/\-/g, '+')
                .replace(/_/g, '/');

            var rawData = window.atob(base64);
            var outputArray = new Uint8Array(rawData.length);

            for (var i = 0; i < rawData.length; ++i) {
                outputArray[i] = rawData.charCodeAt(i);
            }
            return outputArray;
        }

        function storePushSubscription(pushSubscription) {
            const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');

            fetch('/push', {
                method: 'POST',
                body: JSON.stringify(pushSubscription),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': token
                }
            })
                .then((res) => {
                    return res.json();
                })
                .then((res) => {
                    console.log(res)
                })
                .catch((err) => {
                    console.log(err)
                });
        }

        function subscribeUser() {
            navigator.serviceWorker.ready
                .then((registration) => {
                    const subscribeOptions = {
                        userVisibleOnly: true,
                        applicationServerKey: urlBase64ToUint8Array(
                            '{{env('VAPID_PUBLIC_KEY')}}'
                        )
                    };

                    return registration.pushManager.subscribe(subscribeOptions);
                })
                .then((pushSubscription) => {
                    console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
                    storePushSubscription(pushSubscription);
                });
        }

        function initPush() {
            if (!navigator.serviceWorker.ready) {
                return;
            }

            new Promise(function (resolve, reject) {
                const permissionResult = Notification.requestPermission(function (result) {
                    resolve(result);
                });

                if (permissionResult) {
                    permissionResult.then(resolve, reject);
                }
            })
                .then((permissionResult) => {
                    if (permissionResult !== 'granted') {
                        throw new Error('Permissão para enviar notificações foi negada!');
                    }
                    subscribeUser();
                });
        }

		// Register service worker.
		if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('{{ asset('/service-worker.js') }}')
                    .then((reg) => {
                    console.log('Service worker registered.', reg);
                    });
            });
            @auth
            initPush();
            @endauth
		}
	</script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-faded px-5">

        <button id="menu" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Menu') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" width="30" height="30" alt="{{ config('app.name', 'SGSE') }}"> {{ config('app.name', 'SGSE') }}
        </a>

        <a class="navbar-brand d-md-none" href="{{ url('/carrinho') }}">
            <i class="fas fa-shopping-cart"></i>
        </a>
        <div id="mascaramenu"></div>
        <div id="menu2" class="navbar-collapse">
            <ul class="navbar-nav nav-justified w-100">
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
                <li class="nav-item d-none d-md-block">
                    <form method="POST" action="{{ url('/pesquisar') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input name="inputPesquisarProduto" type="text" class="form-control" placeholder="Pesquisar produtos" aria-label="Pesquisar produtos" aria-describedby="btnPesquisa1" value="@if (isset($produtoPesquisado)){{$produtoPesquisado}}@endif">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="btnPesquisa1"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
       </div>
    </nav>

    <div class="d-md-none">
        <div class="row justify-content-center">
            <div class="col-10">
                <form method="POST" action="{{ url('/pesquisar') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="inputPesquisarProduto" type="text" class="form-control" placeholder="Pesquisar produtos" aria-label="Pesquisar produtos" aria-describedby="btnPesquisa2" value="@if (isset($produtoPesquisado)){{$produtoPesquisado}}@endif">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="btnPesquisa2"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <main class="py-2">
        @yield('content')
    </main>
    <script>
        $(document).ready(function(){
        $("#menu").on("click",function(){
        $("#menu2").toggleClass("efeito");
        });
        });

        $(document).ready(function(){
        $("#menu").on("click",function(){
        $("#mascaramenu").toggleClass("efeito");
        });
        });
    </script>


</div>
</body>
</html>
