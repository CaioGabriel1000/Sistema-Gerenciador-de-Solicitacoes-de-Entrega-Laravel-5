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
								Retirar no local 
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
							<div class="row">
								<div class="form-label-group col p-2">
									<label for="cidade">Cidade</label>
									<select class="custom-select" id="cidade_idCidade" name="cidade_idCidade">
										<option value="1">Belo Horizonte</option>
									</select>
								</div>

								<div class="form-label-group col p-2">
									<label for="bairro">Bairro</label>
									<select class="custom-select" id="bairro_idBairro" name="bairro_idBairro">
										<option value="2">Centro</option>
										<option value="1">Hospitais</option>
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
									<label for="observacoesEntrega">Observações</label>
									<input id="observacoesEntrega" name="observacoesEntrega" class="form-control" placeholder="Observações" type="text" maxlength="45">
								</div>
							</div>
							<div class="row">
								<div class="col p-2">
									<label for="valorTotal">Valor Total</label>
									<input class="form-control" type="text" placeholder="R$ XX,XX" readonly>
								</div>
								<div class="col p-2">
									<label for="formaPagamento">Forma de pagamento</label>
									<select class="custom-select" id="formaPagamento" name="formaPagamento">
										<option value="dinheiro">Dinheiro</option>
										<option value="cartao">Cartão</option>
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
						</div>
						<div class="tab-pane fade" id="form-retirar" role="tabpanel" aria-labelledby="form-retirar-tab">
							<div class="row">
								<div class="form-label-group col p-2">
									<label for="enderecoRetirarPedido">Endereço do estabelecimento para retirar o pedido:</label>
									<input class="form-control" type="text" placeholder="Rua X, número Y. Bairro Centro. Belo Horizonte" readonly>
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
									<input class="form-control" type="text" placeholder="R$ XX,XX" readonly>
								</div>
								<div class="col p-2">
									<label for="formaPagamentoRetirar">Forma de pagamento</label>
									<select class="custom-select" id="formaPagamentoRetirar" name="formaPagamentoRetirar">
										<option value="dinheiro">Dinheiro</option>
										<option value="cartao">Cartão</option>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
