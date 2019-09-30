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
						<p class="card-text"><b>R$ {{$p->valorUnitario}}</b></p>
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
			
			@foreach ($grupoProdutos as $g)
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 p-2">
				<div class="card">
				<img src="{{ url('img/produtos/') . '/grupo-' . md5($g->codigoGrupoProdutos) . '.png' }}" class="card-img-top h-auto w-100% mx-auto d-block" alt="Nome produto">
					<div class="card-body">
						<h5 class="card-title">{{$g->nome}}</h5>
						<ul class="nav nav-pills mb-1" id="pills-tab-{{$g->codigoGrupoProdutos}}" role="tablist">
							@foreach ($g->produtos as $p)
							<li class="nav-item">
								@if ($p->codigoProduto == $g->produtos[0]->codigoProduto)
									<a class="nav-link active" id="pills-tab-{{$p->codigoProduto}}" data-toggle="pill" href="#pill-{{$p->codigoProduto}}" role="tab" aria-controls="pill-{{$p->codigoProduto}}" aria-selected="true">{{substr($p->nome, strrpos($p->nome, ' - ') + 3, strlen($p->nome))}}</a>
								@else
									<a class="nav-link" id="pills-tab-{{$p->codigoProduto}}" data-toggle="pill" href="#pill-{{$p->codigoProduto}}" role="tab" aria-controls="pill-{{$p->codigoProduto}}" aria-selected="false">{{substr($p->nome, strrpos($p->nome, ' - ') + 3, strlen($p->nome))}}</a>
								@endif
							</li>
							@endforeach
						</ul>
						<div class="tab-content" id="pills-tabContent-{{$g->codigoGrupoProdutos}}">
						@foreach ($g->produtos as $p)
							@if ($p->codigoProduto == $g->produtos[0]->codigoProduto)
							<div class="tab-pane fade show active" id="pill-{{$p->codigoProduto}}" role="tabpanel" aria-labelledby="pills-tab-{{$p->codigoProduto}}">
								<p><b>R$ {{$p->valorUnitario}}</b></p>
								<p><b>{{$p->categoria->nome}}</b> - {{$p->descricao}}</p>
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
							@else
							<div class="tab-pane fade" id="pill-{{$p->codigoProduto}}" role="tabpanel" aria-labelledby="pills-tab-{{$p->codigoProduto}}">
								<p><b>R$ {{$p->valorUnitario}}</b></p>
								<p><b>{{$p->categoria->nome}}</b> - {{$p->descricao}}</p>
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
							@endif
						@endforeach
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