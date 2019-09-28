@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="container-fluid mobile-card-container cardajust">
			<div class="row text-center flex-nowrap flex-sm-nowrap">
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
		</div>
		
		
		<div class="row justify-content-left">
			@foreach ($produtos as $p)
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 p-2">
				<div class="card">
				<img src="{{ url('img/produtos/') . '/' . md5($p->codigoProduto) . '.png' }}" class="card-img-top h-auto w-100% mx-auto d-block" alt="Nome produto">
					<div class="card-body">
						<h5 class="card-title">{{$p->nome}}</h5>
						@if ($p->codigoCategoria!=2)
						<!-- Caso a categoria for diferente de pizza o valor não sera apresentado -->
						<p class="card-text"><b>R$ {{$p->valorUnitario}}</b></p>
						@endif
						<!-- Caso a categoria for pizza será apresentado as opções de tamanho -->
						@if ($p->codigoCategoria==2)
						<div id="tamanhoprodt">
						<div class="tab-content">
						<!-- M -->
						<div class="tab-pane fade show active" id="M">
							<!-- Conforme o tamanho da pizza o preço irá mudar -->
							<p class="card-text"><b>R$ {{$p->valorUnitario}}</b></p>	
							M
						</div>
						<!-- G -->
						<div class="tab-pane fade" id="G">
							<p class="card-text"><b>R$ {{$p->valorUnitario}}</b></p>
							G							
						</div>
						<!-- GG -->
						<div class="tab-pane fade" id="GG">
							<p class="card-text"><b>R$ {{$p->valorUnitario}}</b></p>
							GG							
						</div>
					</div>
					<div class="row d-flex">
						<ul class="nav mb-3">
							<li class="nav-item btn-group">
								<button type="button" class="btn btn-light active nav-link" onclick="addCarrinho({{$p->codigoProduto}})" data-toggle="pill" href="#M" aria-selected="true" >M</button>
							</li>
							<li class="nav-item">
							<button type="button" class="btn btn-light nav-link" onclick="addCarrinho({{$p->codigoProduto}})" data-toggle="pill" href="#G" aria-selected="true" >G</button>
							</li>
							<li class="nav-item">
							<button type="button" class="btn btn-light nav-link" onclick="addCarrinho({{$p->codigoProduto}})" data-toggle="pill" href="#GG" aria-selected="true" >GG</button>
							</li>
						</ul>
					</div>	
					@endif						
						<p class="card-text"><b>{{$p->categoria->nome}}</b> - {{$p->descricao}}</p>
						<div class="row">
							<div class="col">
								<input id="{{$p->codigoProduto}}" type="number" value="1" min="1" max="{{$p->quantidadeEstoque}}" step="1"/>
							</div>
							<div class="col">
								<button type="button" class="btn btn-primary" onclick="addCarrinho({{$p->codigoProduto}})">
									<i class="fas fa-cart-plus"></i>
									<small>Adicionar ao carrinho</small>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- fim col -->
			@endforeach
		</div> <!-- fim row -->
		@if (method_exists($produtos, 'links'))
			{{ $produtos->links() }}
		@endif
	
	</div>

	<script src="{{ asset('js/bootstrap-input-spinner.js') }}"></script>
	<script type="text/javascript">
		function addCarrinho(codigoProduto) {
			var quantidade = document.getElementById(codigoProduto).value;
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
				url: '/addCarrinho',
				type: 'POST',
				data: {
					_token: CSRF_TOKEN,
					codigoProduto: codigoProduto,
					quantidade: quantidade
				},
				dataType: 'JSON',
				success: function(data){
					alert(data.msg);
				},
				Error: function(data) {
					alert('Erro ao adicionar produto ao carrinho! Verifique sua conexão com a internet!');
				}
			});
		}
		$("input[type='number']").inputSpinner();
	</script>

@endsection
