@extends('layouts.gerenciamento')

@section('content')
<meta http-equiv="refresh" content="30"/>
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
					<div class="card" id="pedido_{{$p->codigoPedido}}">
						<div class="card-header">
							<span class="float-right">
								<a href="#" onclick="createPDF({{$p->codigoPedido}});"><i class="fas fa-print"></i></a>
							</span>
							<h4>Pedido {{$p->codigoPedido}}</h4>
							<p class="d-flex justify-content-between">
								<span>
									<b>Situação: 
										@switch($p->situacao)
											@case('A')
												Aberto
												@break
											@case('E')
												Em processo de entrega
												@break
											@case('F')
												Entregue
												@break
											@case('C')
												Cancelado
												@break
											@default
												Aberto
										@endswitch
									</b>
								</span>
								<span>
									@if ($p->updated_at == NULL)
										{{ date("d-m-Y H:i", strtotime($p->created_at)) }}
									@else
										{{ date("d-m-Y H:i", strtotime($p->updated_at)) }}
									@endif
								</span>
							</p>
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
							<p class="d-flex justify-content-between">
								@if ($p['detalhes'][0]->logradouro == NULL)
									Cliente vai retirar pedido no estabelecimento.
								@else
									<span><b>Endereço: </b> {{$p['detalhes'][0]->logradouro}}, Nº {{$p['detalhes'][0]->numero}}, Bairro {{$p['detalhes'][0]->bairro}}, Cidade {{$p['detalhes'][0]->cidade}}</span>
								@endif
								<span><b>Observação: </b> {{$p->observacoes}}</span>
							</p>
							<p class="d-flex justify-content-between">
								<span><b>Cliente: </b> {{$p['detalhes'][0]->cliente}}</span>
								<span><b>Telefones </b>
									@foreach (TelefoneCliente::where('codigoCliente', $p['detalhes'][0]->codigoCliente)->get() as $t)
											-	{{$t->telefoneCliente }}
									@endforeach
								</span>
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
