<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\PedidoProduto;
use App\Produto;
use App\Cidade;
use App\Bairro;
use App\Estabelecimento;
use App\Endereco;
use App\Entregador;
use App\Pagamento;
use App\Entrega;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

		$dados['pedidos'] = Pedido::where('codigoCliente', Auth::id())->get();

		foreach ($dados['pedidos'] as $key => $value) {
			$dados['pedidos'][$key]['detalhes'] = Pedido::pedidoCliente($value->codigoPedido);
		}

		return view('loja.pedidos', $dados);
	}

	public function finalizarPedido()
	{
		if(session()->has('carrinho')) {
			$dados = [];
			try {
				$dados['bairros'] = Bairro::all();
				$dados['cidades'] = Cidade::all();
				$dados['estabelecimento'] = Estabelecimento::find(1);
				$dados['valorTotal'] = 0;
				foreach (session('carrinho') as $codigoProduto => $quantidade) {
					$dados['valorTotal'] += Produto::find($codigoProduto)->valorUnitario * $quantidade;
				}
			} catch (\Throwable $th) {
				echo 'Ocorreu um erro ao finalizar o pedido! Favor contate o estabelecimento para que isso seja corrigido!';
			}
			return view('loja.finalizar_pedido', $dados);
		} else {
			redirect('/');
		}
	}

	public function salvarPedidoEntrega(Request $request)
    {

		if (session()->has('carrinho')) {

			$valorTotal = 0;

			foreach (session('carrinho') as $codigoProduto => $quantidade) {
				$valorTotal += Produto::find($codigoProduto)->valorUnitario * $quantidade;
			}

			$pedido = array(
				'valorTotal' => $valorTotal,
				'formaPagamento' => $request->formaPagamento,
				'observacoes' => $request->observacoes,
				'situacao' => 'A',
				'criacao' => NOW(),
				'atualizacao' => NOW(),
				'codigoCliente' => Auth::user()->codigoCliente,
			);

			$codigoPedido = Pedido::create($pedido)->codigoPedido;

			$pedidoProduto;

			foreach (session('carrinho') as $codigoProduto => $quantidade) {
				$pedidoProduto = array(
					'codigoProduto' => $codigoProduto,
					'codigoPedido' => $codigoPedido,
					'quantidade' => $quantidade,
				);

				PedidoProduto::create($pedidoProduto);
			}

			$endereco = array(
				'logradouro' => $request->logradouro,
				'numero' => $request->numero,
				'complemento' => $request->complemento,
				'codigoBairro' => $request->codigoBairro,
			);

			$codigoEndereco = Endereco::create($endereco)->codigoEndereco;

			$codigoEntregador = Entregador::find(1)->codigoEntregador;
			
			$entrega = array(
				'situacao' => 'A',
				'codigoPedido' => $codigoPedido,
				'codigoEndereco' => $codigoEndereco,
				'codigoEntregador' => $codigoEntregador,
			);

			Entrega::create($entrega);

			$pagamento = array(
				'valor' => $valorTotal,
				'situacao' => 'A',
				'codigoPedido' => $codigoPedido,
			);

			Pagamento::create($pagamento);

			$request->session()->forget('carrinho');

			return redirect('pedidos');
			
		} else {
			echo 'Ocorreu um erro ao salvar o pedido! Favor contate o estabelecimento para que isso seja corrigido!';
		}
    }
}
