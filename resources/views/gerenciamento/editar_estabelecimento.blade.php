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

<h1 class="mb-3">Editar estabelecimento</h1>
<form method="POST" enctype="multipart/form-data" action="{{ action('Gerenciamento\EstabelecimentoController@update',$id) }}">

		@csrf

		<input type="hidden" name="_method" value="PATCH">

		<div class="form-group mb-3">
			<label for="nome">Razão Social</label>
		<input type="text" class="form-control" id="razaoSocial" name="razaoSocial" value="{{$estabelecimento->razaoSocial}}" placeholder="Digite o razão social do estabelecimento..." required>
		</div>

		<div class="form-group mb-3">
			<label for="nome">Nome Fantasia</label>
		<input type="text" class="form-control" id="nomeFantasia" name="nomeFantasia" value="{{$estabelecimento->nomeFantasia}}" placeholder="Digite o nome fantasia do estabelecimento..." required>
		</div>

		<div class="form-group mb-3">
			<label for="nome">CNPJ</label>
		<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="{{$estabelecimento->cnpj}}" placeholder="Digite o CNPJ do estabelecimento..." required>
		</div>

		<div class="form-group mb-3">
			<label for="nome">Início Jornada Funcionamento</label>
		<input type="text" class="form-control time" id="inicioJornadaFuncionamento" name="inicioJornadaFuncionamento" value="{{$estabelecimento->inicioJornadaFuncionamento}}" placeholder="Digite o horário de início da jornada de funcionamento do estabelecimento..." required>
		</div>

		<div class="form-group mb-3">
			<label for="nome">Fim Jornada Funcionamento</label>
		<input type="text" class="form-control time" id="fimJornadaFuncionamento" name="fimJornadaFuncionamento" value="{{$estabelecimento->fimJornadaFuncionamento}}" placeholder="Digite o horário de fim da jornada de funcionamento do estabelecimento..." required>
		</div>

		<div class="form-group mb-3">
			<label for="exampleFormControlSelect2">Dias Funcionamento</label>
			<select multiple class="form-control" id="diasFuncionamento[]" name="diasFuncionamento[]">
				<option value="1" @if ($estabelecimento->diasFuncionamento & 1) selected="selected" @endif >Domingo</option>
				<option value="2" @if ($estabelecimento->diasFuncionamento & 2) selected="selected" @endif >Segunda-feira</option>
				<option value="4" @if ($estabelecimento->diasFuncionamento & 4) selected="selected" @endif >Terça-feira</option>
				<option value="8" @if ($estabelecimento->diasFuncionamento & 8) selected="selected" @endif >Quarta-feira</option>
				<option value="16" @if ($estabelecimento->diasFuncionamento & 16) selected="selected" @endif >Quinta-feira</option>
				<option value="32" @if ($estabelecimento->diasFuncionamento & 32) selected="selected" @endif >Sexta-feira</option>
				<option value="64" @if ($estabelecimento->diasFuncionamento & 64) selected="selected" @endif >Sábado</option>
			</select>
		</div>

		<div class="form-group mb-3">
			<label for="identidadeVisual">Identidade Visual</label>
			<select class="custom-select" id="identidadeVisual" name="identidadeVisual">
				<option value="G" @if ($estabelecimento->identidadeVisual == 'G') selected="selected" @endif >Cinza - Padrão</option>
				<option value="P" @if ($estabelecimento->identidadeVisual == 'P') selected="selected" @endif >Preto</option>
				<option value="A" @if ($estabelecimento->identidadeVisual == 'A') selected="selected" @endif >Azul</option>
				<option value="R" @if ($estabelecimento->identidadeVisual == 'R') selected="selected" @endif >Rosa</option>
				<option value="V" @if ($estabelecimento->identidadeVisual == 'V') selected="selected" @endif >Vermelho</option>
			</select>
		</div>

		<div class="form-group mb-3">
			<label for="sku">Logomarca do estabelecimento (imagem compactada com extensão png)</label>
			<input type="file" class="form-control-file" id="imagemLogomarca" name="imagemLogomarca">
		</div>

		<button type="submit" class="btn btn-primary">Atualizar</button>
	</form>
</div>

<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$('.time').mask('00:00');
		$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
	});
</script>

@endsection