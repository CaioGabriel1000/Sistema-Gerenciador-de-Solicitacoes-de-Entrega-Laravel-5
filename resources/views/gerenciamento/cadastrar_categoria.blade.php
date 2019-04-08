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

<h1 class="mb-3">Cadastrar categoria de produtos</h1>
<form method="POST" action="{{ route('categoria.store') }}">

		@csrf

		<div class="form-group mb-3">
			<label for="nome">Nome</label>
			<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome da categoria..." required>
		</div>

		<button type="submit" class="btn btn-primary">Cadastrar</button>

	</form>

</div>

@endsection