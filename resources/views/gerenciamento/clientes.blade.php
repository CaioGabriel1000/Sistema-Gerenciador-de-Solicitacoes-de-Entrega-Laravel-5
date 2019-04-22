@extends('layouts.gerenciamento')

@section('content')
<div class="container">

	@if ($message = Session::get('success'))

	<div class="alert alert-success">
		{{$message}}
	</div>
		
	@endif

	@if ($message = Session::get('error'))

	<div class="alert alert-warning">
		{{$message}}
	</div>
		
	@endif

	<div class="table-wrapper">
		<div class="table-title">
			<div class="row justify-content-between">
				<div class="col">
					<h1><small>Gerenciar clientes</small></h1>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Código cliente</th>
					<th>Nome</th>
					<th>Email</th>
					<th>Situação</th>
					<th>Opções</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@foreach ($clientes as $c)

				<tr>
					<td>{{$c->codigoCliente}}</td>
					<td>{{$c->name}}</td>
					<td>{{$c->email}}</td>
					<td>
						@if ($c->situacao == 'A')
							ATIVO
						@else
							BLOQUEADO
						@endif
					</td>
					<td>
						<form method="POST" action="{{ action('Gerenciamento\ClienteController@update',$c->codigoCliente) }}">
							@csrf
							<input type="hidden" name="_method" value="PATCH">
							<input type="hidden" name="situacao" value="A">
							<button class="btn btn-warning"><i class="fas fa-check"></i><small>	Desbloquear</small></button>
						</form>
					</td>
					<td>
						<form method="POST" action="{{ action('Gerenciamento\ClienteController@update',$c->codigoCliente) }}">
							@csrf
							<input type="hidden" name="_method" value="PATCH">
							<input type="hidden" name="situacao" value="I">
							<button class="btn btn-danger"><i class="fas fa-times"></i><small>	Bloquear</small></button>
						</form>
					</td>
				</tr>

				@endforeach

			</tbody>
		</table>
	</div>

	{{ $clientes->links() }}

</div>

@endsection