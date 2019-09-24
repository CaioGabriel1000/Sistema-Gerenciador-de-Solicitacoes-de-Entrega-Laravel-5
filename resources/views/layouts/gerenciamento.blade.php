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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/canvas2image@1.0.5/canvas2image.min.js"></script>

	<script language="javascript">
		(function($){
			$.fn.createPdf = function(parametros) {
				
				var config = {              
					'fileName':'html-to-pdf'
				};
				
				if (parametros){
					$.extend(config, parametros);
				}                            
	
				var quotes = document.getElementById($(this).attr('id'));
	
				html2canvas(quotes, {
					onrendered: function(canvas) {
						var pdf = new jsPDF('p', 'pt', 'letter');
	
						for (var i = 0; i <= quotes.clientHeight/980; i++) {
							var srcImg  = canvas;
							var sX      = 0;
							var sY      = 980*i;
							var sWidth  = 900;
							var sHeight = 980;
							var dX      = 0;
							var dY      = 0;
							var dWidth  = 900;
							var dHeight = 980;
	
							window.onePageCanvas = document.createElement("canvas");
							onePageCanvas.setAttribute('width', 900);
							onePageCanvas.setAttribute('height', 980);
							var ctx = onePageCanvas.getContext('2d');
							ctx.drawImage(srcImg,sX,sY,sWidth,sHeight,dX,dY,dWidth,dHeight);
	
							var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
							var width         = onePageCanvas.width;
							var height        = onePageCanvas.clientHeight;
	
							if (i > 0) {
								pdf.addPage(612, 791);
							}
	
							pdf.setPage(i+1);
							pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width*.62), (height*.62));
						}
	
						pdf.autoPrint();
						window.open(pdf.output('bloburl'), '_blank');
					}
				});
			};
		})(jQuery);
			
		function createPDF(codigoPedido) {
			$('#pedido_'+codigoPedido).createPdf({
				'fileName' : 'pedido_'+codigoPedido
			});
		}
	</script>

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
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Produtos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ url('/gerenciamento/produto') }}">Produtos</a>
							<a class="dropdown-item" href="{{ url('/gerenciamento/grupoprodutos') }}">Grupos de Produtos</a>
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
					<a class="nav-link" href="{{ url('/gerenciamento/estabelecimento') }}">Configurações</a>
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
