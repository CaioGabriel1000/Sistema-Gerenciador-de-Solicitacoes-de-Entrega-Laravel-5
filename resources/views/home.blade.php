@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row justify-content-left">
			@foreach ($produtos as $p)
			<div class="col-md-4 p-2">
				<div class="card">
				<img src="{{ url('img/produtos/') . '/' . $p->codigoProduto . '.png' }}" class="card-img-top h-100 w-50 mx-auto d-block" alt="Nome produto">
					<div class="card-body">
						<h5 class="card-title">{{$p->nome}}</h5>
						<p class="card-text"><b>R$ {{$p->valorUnitario}}</b></p>
						<p class="card-text">{{$p->descricao}}</p>
						<div class="row">
							<div class="col">
								<input id="{{$p->codigoProduto}}" type="number" value="1" min="1" max="{{$p->quantidadeEstoque}}" step="1"/>
							</div>
							<div class="col">
								<button type="button" class="btn btn-primary" onclick="addCarrinho({{$p->codigoProduto}})">
									<i class="fas fa-cart-plus"></i>
									<small>Adicionar ao carrinho</small>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- fim col -->
			@endforeach
		</div> <!-- fim row -->
		{{ $produtos->links() }}
	</div> <!-- fim container -->

	<script src="{{ asset('js/bootstrap-input-spinner.js') }}"></script>
	<script type="text/javascript">
		function addCarrinho(codigoProduto) {
			var quantidade = document.getElementById(codigoProduto).value;
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			console.log('variaveis antes do POST');
			console.log(codigoProduto);
			console.log(quantidade);
			console.log(CSRF_TOKEN);
			$.ajax({
				url: '/addCarrinho',
				type: 'POST',
				data: {
					_token: CSRF_TOKEN,
					codigoProduto: codigoProduto,
					quantidade: quantidade
				},
				dataType: 'JSON',
				success: function(data){
					console.log(data.vlr);
					alert(data.msg);
				},
				Error: function(data) {
					console.log(data.vlr);
					alert(data.msg);
				}
			});
		}
		$("input[type='number']").inputSpinner();
	</script>

@endsection
