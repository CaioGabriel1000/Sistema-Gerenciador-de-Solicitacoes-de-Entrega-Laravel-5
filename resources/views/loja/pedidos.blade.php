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
					<div class="card">
						<div class="card-header">
							<h4>Pedido X</h4>
							<p>
								<b>Situação: Entregue</b>
							</p>
						</div>
						<div class="card-body">
							<ul class="list-group list-group-flush">
								<li class="box-shadow list-group-item d-flex justify-content-between lh-condensed">
									<div>
										<h6 class="my-0">Produto</h6>
										<small class="text-muted d-none d-md-block">Descrição</small>
									</div>
									<span class="text-muted"><b>R$ XX,XX</b></span>
								</li>
							</ul>
						</div>
						<div class="card-footer justify-content-between">
							<p>
								<b>Valor Total: R$ XX,XX</b>
							</p>
							<p>
								<b>Endereço: </b> ...
							</p>
							<p>
								<b>Observação: </b> ...
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
