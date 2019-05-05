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

<h1 class="mb-3">Editar bairro</h1>
<form method="POST" enctype="multipart/form-data" action="{{ action('Gerenciamento\BairroController@update',$id) }}">

		@csrf

		<input type="hidden" name="_method" value="PATCH">

		<div class="form-group mb-3">
			<label for="nome">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" value="{{$bairro->nome}}" placeholder="Digite o nome do produto..." required>
		</div>

		<div class="form-group mb-3">
			<label for="codigoCidade">Cidade</label>
			<select class="custom-select" id="codigoCidade" name="codigoCidade">
			@foreach ($cidades as $c)
				<option value="{{ $c->codigoCidade }}"
					@if ($c->codigoCidade == $bairro->codigoCidade)
					selected="selected"
					@endif
					>{{$c->nome}}</option>
			@endforeach
			</select>
		</div>

		<div class="form-group mb-3">
			<label for="nome">Valor do frete</label>
			<input type="number" step="0.01" min=0 class="form-control" id="valorFrete" name="valorFrete" value="{{$bairro->valorFrete}}" placeholder="Digite o valor do frete para entregas nesse bairro..." required>
		</div>

		<button type="submit" class="btn btn-primary">Atualizar</button>
	</form>
</div>

@endsection