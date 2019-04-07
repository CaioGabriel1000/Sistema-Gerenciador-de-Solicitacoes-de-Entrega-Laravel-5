@extends('layouts.gerenciamento')

@section('content')

<div class="container">

@if ($message = Session::get('success'))

<div class="alert alert-success">
	{{$message}}
</div>
	
@endif

@if ($message = Session::get('error'))

<div class="alert alert-danger">
	{{$message}}
</div>
	
@endif

@if (count($errors) > 0)

<div class="alert alert-danger">
	<ul>

		@foreach ($errors->all() as $e)

		<li>{{$e}}</li>

		@endforeach
		
	</ul>
</div>
	
@endif

<h1 class="mb-3">Cadastrar produto</h1>
<form method="POST" enctype="multipart/form-data" action="{{ route('produto.store') }}">

		@csrf

		<div class="form-group mb-3">
			<label for="nome">Nome</label>
			<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do produto..." required>
		</div>

		<div class="form-group mb-3">
			<label for="sku">SKU</label>
			<input type="text" class="form-control" id="sku" name="sku" placeholder="Digite o SKU..." required>
		</div>

		<label for="preco">Preço</label>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">R$</span>
			</div>
			<input type="number" step=".01" class="form-control" id="valorUnitario" name="valorUnitario" placeholder="0,00" required>
		</div>

		<div class="form-group mb-3">
			<label for="quantidadeEstoque">Quantidade Estoque</label>
			<input type="number" class="form-control" id="quantidadeEstoque" name="quantidadeEstoque" placeholder="Digite a quantidade de unidades no estoque..." required>
		</div>

		<div class="form-group mb-3">
			<label for="descricao">Descrição</label>
			<textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Digite uma breve descrição do produto..." required></textarea>
		</div>

		<div class="form-group">
			<label for="codigoCategoria">Categoria</label>
			<select id="codigoCategoria" name="codigoCategoria" class="form-control">

				@foreach ($categorias as $c)

				<option value="{{$c->codigoCategoria}}">{{$c->nome}}</option>

				@endforeach

			</select>
		</div>

		<div class="form-group mb-3">
			<label for="sku">Imagem do produto (imagem compactada com extensão png)</label>
			<input type="file" class="form-control-file" id="imagemProduto" name="imagemProduto" required>
		</div>

		<button type="submit" class="btn btn-primary">Cadastrar</button>

	</form>

</div>

@endsection