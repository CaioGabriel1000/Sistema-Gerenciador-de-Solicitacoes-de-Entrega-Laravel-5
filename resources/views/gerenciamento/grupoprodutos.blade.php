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
					<h1><small>Gerenciar grupos de produtos</small></h1>
				</div>
				<div class="col">
					<a href="{{url('/gerenciamento/grupoprodutos/create')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i><span>	Cadastrar novo grupo de produtos</span></a>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Código Grupo Produtos</th>
					<th>Nome</th>
					<th>Opções</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@foreach ($grupoProdutos as $p)

				<tr>
					<td>{{$p->codigoGrupoProdutos}}</td>
					<td>{{$p->nome}}</td>
					<td>
						<a href="{{url('/gerenciamento/grupoprodutos/').'/'.$p->codigoGrupoProdutos.'/edit'}}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i><small>	Editar</small></a>
					</td>
					<td>
						<form method="POST" action="{{ action('Gerenciamento\GrupoProdutosController@destroy',$p->codigoGrupoProdutos) }}">
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

	{{ $grupoProdutos->links() }}

</div>

@endsection