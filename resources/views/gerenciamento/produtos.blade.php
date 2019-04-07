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
					<h1><small>Gerenciar produtos</small></h1>
				</div>
				<div class="col">
					<a href="{{url('/gerenciamento/produto/create')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i><span>	Cadastrar novo produto</span></a>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Código Produto</th>
					<th>Nome</th>
					<th>SKU</th>
					<th>Valor Unitário</th>
					<th>Quantidade Estoque</th>
					<th>Categoria</th>
					<th>Opções</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

				@foreach ($produtos as $p)

				<tr>
					<td>{{$p->codigoProduto}}</td>
					<td>{{$p->nome}}</td>
					<td>{{$p->sku}}</td>
					<td>{{$p->valorUnitario}}</td>
					<td>{{$p->quantidadeEstoque}}</td>
					<td>{{$p->categoria->nome}}</td>
					<td>
						<a href="{{url('/gerenciamento/produto/').'/'.$p->codigoProduto.'/edit'}}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i><small>	Editar</small></a>
					</td>
					<td>
						<form method="POST" action="{{ action('Gerenciamento\ProdutoController@destroy',$p->codigoProduto) }}">
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

	{{ $produtos->links() }}

</div>

@endsection