@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="text-center">
						<div class="d-block mx-auto mb-3">
							<i class="fas fa-shopping-cart fa-3x"></i>
						</div>
						<h1><small>Carrinho de Compras</small></h1>
					</div>
				</div>

				@if (isset($produtos))

					<div class="card-body">
						<ul class="list-group list-group-flush">
							@foreach ($produtos as $p)
								<li class="box-shadow list-group-item d-flex justify-content-between lh-condensed">
									<div>
										<h6 class="my-0">{{$p->quantidade}} x {{$p->nome}}</h6>
										<small class="text-muted d-none d-md-block">{{$p->descricao}}</small>
									</div>
									<span class="text-muted"><b>R$ {{$p->valorUnitario}}</b></span>
									<button type="button" class="btn btn-danger btn-sm" id="0" name="0" value="0" onclick="rmvCarrinho({{$p->codigoProduto}})">
										<i class="fas fa-times"></i>
										<small>Remover</small>
									</button>
								</li>
							@endforeach
						</ul>
					</div>
					<div class="card-footer justify-content-between">
						<span>Total (R$)
							<b>{{$valorTotal}}</b>
						</span>
						<a href="{{ url('/finalizar_pedido') }}">
							<button type="button" class="btn float-right btn-success">
								<i class="fas fa-check"></i> 
								<b>Finalizar Pedido</b>
							</button>
						</a>
					</div>

				@else
					<div class="card-body">
					<p class="text-center"> Carrinho vazio! <a href="{{ url('/') }}">Clique aqui para escolher seus produtos!</a> </p>
					</div>
				@endif
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function rmvCarrinho(codigoProduto) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '/rmvCarrinho',
			type: 'POST',
			data: {
				_token: CSRF_TOKEN,
				codigoProduto: codigoProduto
			},
			dataType: 'JSON',
			success: function(data){
				alert(data.msg);
				window.location.reload();
			},
			Error: function(data) {
				alert(data.msg);
				window.location.reload();
			}
		});
	}
</script>

@endsection
