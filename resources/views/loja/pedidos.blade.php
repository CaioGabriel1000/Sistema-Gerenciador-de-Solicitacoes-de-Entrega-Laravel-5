@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="text-center">
						<div class="d-block mx-auto mb-3">
							<i class="fas fa-clipboard-list fa-3x"></i>
						</div>
						<h1><small>Meus Pedidos</small></h1>
					</div>
				</div>
				<div class="card-body">

				@if (!empty($pedidos[0]))
					
					@foreach ($pedidos as $p)
					<div class="card">
						<div class="card-header">
							<h4>Pedido {{$p->codigoPedido}}</h4>
							<p>
								<b>Situação: 
									@switch($p->situacao)
										@case('A')
											Aberto
											@break
										@case('F')
											Fechado
											@break
										@default
											Aberto
									@endswitch
								</b>
							</p>
						</div>
						<div class="card-body">
							<ul class="list-group list-group-flush">
								@foreach ($p->detalhes as $d)
									<li class="box-shadow list-group-item d-flex justify-content-between">
										<small class="text-muted d-none d-md-block">{{$d->quantidade}} X {{$d->produto}}</small>
										<span class="text-muted"><small>R$ {{$d->valorUnitario}}</small></span>
									</li>
								@endforeach
							</ul>
						</div>
						<div class="card-footer justify-content-between">
							<p>
								<b>Valor Total: R$ {{$p->valorTotal}}</b>
							</p>
							<p>
								<b>Endereço: </b> {{$p['detalhes'][0]->logradouro}}, Nº {{$p['detalhes'][0]->numero}}, Bairro {{$p['detalhes'][0]->bairro}}, Cidade {{$p['detalhes'][0]->cidade}}
							</p>
							<p>
								<b>Observação: </b> {{$p->observacoes}}
							</p>
						</div>
					</div>
					<br>
					@endforeach

				@else

					<h6 class="text-center">Nenhum pedido! <a href="{{ url('/') }}">Clique aqui para escolher seus produtos!</a></h6>
					
				@endif
	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
