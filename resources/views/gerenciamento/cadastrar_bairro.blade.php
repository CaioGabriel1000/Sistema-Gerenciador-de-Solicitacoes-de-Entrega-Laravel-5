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

<h1 class="mb-3">Cadastrar bairro</h1>
<form method="POST" action="{{ route('bairro.store') }}">

		@csrf

		<div class="form-group mb-3">
			<label for="nome">Nome</label>
			<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do bairro..." required>
		</div>

		<div class="form-group mb-3">
			<label for="codigoCidade">Cidade</label>
			<select class="custom-select" id="codigoCidade" name="codigoCidade">
			@foreach ($cidades as $c)
				<option value="{{ $c->codigoCidade }}">{{$c->nome}}</option>
			@endforeach
			</select>
		</div>

		

		<button type="submit" class="btn btn-primary">Cadastrar</button>

	</form>

</div>

@endsection