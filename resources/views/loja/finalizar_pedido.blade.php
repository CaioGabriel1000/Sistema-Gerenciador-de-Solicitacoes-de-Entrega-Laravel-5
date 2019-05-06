@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="text-center">
						<h1><small>Finalizar Pedido</small></h1>
					</div>
				</div>
				<div class="card-body">
					<div class="row justify-content-center">
						<ul class="nav nav-pills" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link" id="form-retirar-tab" data-toggle="pill" href="#form-retirar" role="tab" aria-controls="form-retirar" aria-selected="false">
								Retirar no estabelecimento 
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active show" id="form-entregar-tab" data-toggle="pill" href="#form-entregar" role="tab" aria-controls="form-entregar" aria-selected="true">
								Entregar em domicílio 
								</a>
							</li>
						</ul>
					</div>
					<div class="tab-content" id="pills-tabContent">
						
						<div class="tab-pane fade active show" id="form-entregar" role="tabpanel" aria-labelledby="form-entregar-tab">
							<form method="POST" action="{{ url('/addPedidoEntrega') }}">
								@csrf
			
								<div class="row">
									<div class="form-label-group col p-2">
										<label for="codigoCidade">Cidade</label>
										<select class="custom-select" id="codigoCidade" name="codigoCidade" onchange="somarValorTotal(this.options[this.selectedIndex].text)">
											@foreach ($cidades as $c)
												<option value="{{ $c->codigoCidade }}">{{$c->nome}} @if ($c->valorFrete != 0) + frete R$ {{$c->valorFrete}} @endif</option>
											@endforeach
										</select>
									</div>

									<div class="form-label-group col p-2">
										<label for="codigoBairro">Bairro</label>
										<select class="custom-select" id="codigoBairro" name="codigoBairro" onchange="somarValorTotal(this.options[this.selectedIndex].text)">
											@foreach ($bairros as $b)
										<option value="{{ $b->codigoBairro }}">{{$b->nome}} @if ($b->valorFrete != 0) + frete R$ {{$b->valorFrete}} @endif</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-label-group col-sm-8 p-2">
										<label for="logradouro">Logradouro</label>
										<input id="logradouro" name="logradouro" class="form-control" placeholder="Logradouro" required type="text" maxlength="45">
									</div>

									<div class="form-label-group col p-2">
										<label for="numero">Número</label>
										<input id="numero" name="numero" class="form-control" placeholder="Número" required type="text" maxlength="10">
									</div>
								</div>
								<div class="row">
									<div class="col p-2">
										<label for="complemento">Complemento</label>
										<input id="complemento" name="complemento" class="form-control" placeholder="Complemento" type="text" maxlength="45">
									</div>
									<div class="col p-2">
										<label for="observacoes">Observações</label>
										<input id="observacoes" name="observacoes" class="form-control" placeholder="Observações" type="text" maxlength="45">
									</div>
								</div>
								<div class="row">
									<div class="col p-2">
										<label for="valorTotal">Valor Total</label>
										<input id="valorTotal" class="form-control" type="number" placeholder="R$ {{$valorTotal}}" value="{{$valorTotal}}" readonly>
									</div>
									<div class="col p-2">
										<label for="formaPagamento">Forma de pagamento</label>
										<select class="custom-select" id="formaPagamento" name="formaPagamento">
											<option value="D">Dinheiro</option>
											<option value="C">Cartão</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col text-center p-1">
										<button id="btnFinalizarEntrega" name="btnFinalizarEntrega" class="btn btn-success btn-lg" type="submit" value="true">
											Finalizar pedido
										</button>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="form-retirar" role="tabpanel" aria-labelledby="form-retirar-tab">
							<form method="POST" action="{{ url('/addPedidoRetirar') }}">
								@csrf
				
								<div class="row">
									<div class="form-label-group col p-2">
										<label for="enderecoRetirarPedido">Retirar produtos no estabelecimento:</label>
									<input class="form-control" type="text" placeholder="{{env('ENDERECO_LOJA')}}" readonly>
									</div>
								</div>
								<div class="row">
									<div class="col p-2">
										<label for="observacoesRetirar">Observações</label>
										<input id="observacoesRetirar" name="observacoesRetirar" class="form-control" placeholder="Observações" type="text" maxlength="45">
									</div>
								</div>
								<div class="row">
									<div class="col p-2">
										<label for="valorTotalRetirar">Valor Total</label>
										<input class="form-control" type="text" placeholder="R$ {{$valorTotal}}" readonly>
									</div>
									<div class="col p-2">
										<label for="formaPagamentoRetirar">Forma de pagamento</label>
										<select class="custom-select" id="formaPagamentoRetirar" name="formaPagamentoRetirar">
											<option value="D">Dinheiro</option>
											<option value="C">Cartão</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col text-center p-1">
										<button id="btnFinalizarRetirar" name="btnFinalizarRetirar" class="btn btn-success btn-lg" type="submit" value="true">
											Finalizar pedido
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				@if (! ($estabelecimento->inicioJornadaFuncionamento == 0 && $estabelecimento->fimJornadaFuncionamento == 1440 && $estabelecimento->diasFuncionamento == 127))
					<div class="card-footer justify-content-between">
						<div class="alert alert-warning">Atendemos de {{$estabelecimento->minutesToHours($estabelecimento->inicioJornadaFuncionamento)}} às {{$estabelecimento->minutesToHours($estabelecimento->fimJornadaFuncionamento)}} <br>
						Nos dias 
						@if ($estabelecimento->diasFuncionamento & 1) Domingo, @endif
						@if ($estabelecimento->diasFuncionamento & 2) Segunda, @endif
						@if ($estabelecimento->diasFuncionamento & 4) Terça, @endif
						@if ($estabelecimento->diasFuncionamento & 8) Quarta, @endif
						@if ($estabelecimento->diasFuncionamento & 16) Quinta, @endif
						@if ($estabelecimento->diasFuncionamento & 32) Sexta, @endif
						@if ($estabelecimento->diasFuncionamento & 64) Sábado @endif
						</div>
					</div>
				@endif

			</div>
		</div>
	</div>
</div>
<script>
	function somarValorTotal(opcao) {
		var valorAtual = parseFloat(document.getElementById("valorTotal").value);
		var inicioStringFrete = opcao.indexOf("R$ ");
		var valorFrete = opcao.substring((inicioStringFrete + 3), opcao.length);
		var valor = parseFloat(valorAtual) + parseFloat(valorFrete);
		if (valor > 0) {
			document.getElementById("valorTotal").value = valor;
			document.getElementById("valorTotal").placeholder = "R$ " + valor;
		}
	}
</script>
@endsection
