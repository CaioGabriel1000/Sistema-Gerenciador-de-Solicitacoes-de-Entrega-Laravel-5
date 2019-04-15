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
					<h1><small>Gerenciar funcionarios</small></h1>
				</div>
				<div class="col">
					<a href="{{url('/gerenciamento/funcionario/create')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i><span>	Cadastrar novo funcionario</span></a>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Código Funcionário</th>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Administrador</th>
					<th>Situação</th>
					<th>Opções</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@foreach ($funcionarios as $f)

				<tr>
					<td>{{$f->codigoFuncionario}}</td>
					<td>{{$f->name}}</td>
					<td>{{$f->email}}</td>
					<td>
						@if ($f->administrador == 1)
							Sim
						@else
							Não
						@endif
					</td>
					<td>
						@if ($f->situacao == 'A')
							Ativo
						@else
							Inativo
						@endif
					</td>
					<td>
						<a href="{{url('/gerenciamento/funcionario/').'/'.$f->codigoFuncionario.'/edit'}}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i><small>	Editar</small></a>
					</td>
					<td>
						<form method="POST" action="{{ action('Gerenciamento\FuncionarioController@destroy',$f->codigoFuncionario) }}">
							@csrf
							<input type="hidden" name="_method" value="DELETE">
							<button class="btn btn-danger"><i class="fas fa-times"></i><small>	Excluir</small></button>
						</form>
					</td>
				</tr>

				@endforeach

			</tbody>
		</table>
	</div>

	{{ $funcionarios->links() }}

</div>

@endsection