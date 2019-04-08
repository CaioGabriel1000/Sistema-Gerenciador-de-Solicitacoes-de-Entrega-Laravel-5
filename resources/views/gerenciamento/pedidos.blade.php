@extends('layouts.gerenciamento')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<div class="text-center">
						<h1><small>Pedidos Abertos</small></h1>
					</div>
				</div>
				<div class="card-body">

				@if (!empty($pedidos[0]))
					
					@foreach ($pedidos as $p)
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<h4>Pedido {{$p->codigoPedido}}</h4>
							<span>
								<b>Situação: 
									@switch($p->situacao)
										@case('A')
											Aberto
											@break
										@case('P')
											Em processo de entrega
											@break
										@case('F')
											Fechado
											@break
										@default
											Aberto
									@endswitch
								</b>
							</span>
						</div>
						<div class="card-body">
							<ul class="list-group list-group-flush">
								@foreach ($p->detalhes as $d)
									<li class="box-shadow list-group-item d-flex justify-content-between">
										<span class="d-none d-md-block">{{$d->quantidade}} X {{$d->produto}}</span>
										<span>R$ {{$d->valorUnitario}}</span>
									</li>
								@endforeach
							</ul>
						</div>
						<div class="card-footer justify-content-between">
							<p class="d-flex justify-content-between">
								<span><b>Valor Total: R$ {{$p->valorTotal}}</b></span>
								<span><b>Forma de pagamento: </b>
									@switch($p->formaPagamento)
										@case('D')
											Dinheiro
											@break
										@case('C')
											Cartão
											@break
										@default
											Dinheiro
									@endswitch
								</span>
							</p>
							<p>
								<b>Endereço: </b> {{$p['detalhes'][0]->logradouro}}, Nº {{$p['detalhes'][0]->numero}}, Bairro {{$p['detalhes'][0]->bairro}}, Cidade {{$p['detalhes'][0]->cidade}}
							</p>
							<p>
								<b>Observação: </b> {{$p->observacoes}}
							</p>
							<p class="d-flex justify-content-between">
								<button class="btn btn-danger" onclick="cancelar({{$p->codigoPedido}})">Cancelar</button>
								<button class="btn btn-success" onclick="entregar({{$p->codigoPedido}})">Entregar</button>
							</p>
						</div>
					</div>
					<br>
					@endforeach

				@else

					<h6 class="text-center">Nenhum pedido!</h6>
					
				@endif
	
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function cancelar(codigoPedido) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '/cancelarPedido',
			type: 'POST',
			data: {
				_token: CSRF_TOKEN,
				codigoPedido: codigoPedido
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
	function entregar(codigoPedido) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '/entregarPedido',
			type: 'POST',
			data: {
				_token: CSRF_TOKEN,
				codigoPedido: codigoPedido
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
	function finalizar(codigoPedido) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '/finalizarPedido',
			type: 'POST',
			data: {
				_token: CSRF_TOKEN,
				codigoPedido: codigoPedido
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
