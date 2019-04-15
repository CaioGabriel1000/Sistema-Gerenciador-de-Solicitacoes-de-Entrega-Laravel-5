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

<h1 class="mb-3">Editar funcionario</h1>

<form method="POST" action="{{ action('Gerenciamento\FuncionarioController@update',$id) }}">
	@csrf

	<input type="hidden" name="_method" value="PATCH">

	<div class="form-group row">
		<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

		<div class="col-md-6">
			<input id="name" type="text" value="{{$funcionario->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
		</div>
	</div>

	<div class="form-group row">
		<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

		<div class="col-md-6">
			<input id="email" type="email" value="{{$funcionario->email}}"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
		</div>
	</div>
	
	<div class="form-group row">
		<label for="administrador" class="col-md-4 col-form-label text-md-right">Administrador? </label>

		<div class="form-check-inline">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="administrador" value="1" {{$funcionario->administrador == 1 ? 'checked' : ''}}>Sim
			</label>
		</div>
		<div class="form-check-inline">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="administrador" value="0" {{$funcionario->administrador == 0 ? 'checked' : ''}}>Não
			</label>
		</div>
	</div>

	<div class="form-group row">
		<label for="situacao" class="col-md-4 col-form-label text-md-right">Situação </label>

		<div class="form-check-inline">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="situacao" value="A" {{$funcionario->situacao == 'A' ? 'checked' : ''}}>Ativo
			</label>
		</div>
		<div class="form-check-inline">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="situacao" value="I" {{$funcionario->situacao == 'I' ? 'checked' : ''}}>Inativo
			</label>
		</div>
	</div>

	<div class="form-group row">
		<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

		<div class="col-md-6">
			<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
		</div>
	</div>

	<div class="form-group row">
		<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Senha') }}</label>

		<div class="col-md-6">
			<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
		</div>
	</div>

	<div class="form-group row mb-0">
		<div class="col-md-6 offset-md-4">
			<button type="submit" class="btn btn-primary">
				{{ __('Atualizar') }}
			</button>
		</div>
	</div>
</form>
</div>

@endsection