<?php

namespace App\Http\Controllers\Gerenciamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Validator;
use App\Notifications\PushPedidoCliente;
use Notification;
use App\Cliente;

class PedidoController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:funcionarioWeb');
    }

    public function index()
    {
		$dados['pedidos'] = Pedido::where('situacao', 'A')->orderBy('created_at', 'ASC')->get();
		foreach ($dados['pedidos'] as $key => $value) {
			$dados['pedidos'][$key]['detalhes'] = Pedido::pedidoCliente($value->codigoPedido);
		}
		return view('gerenciamento.pedidos', $dados);
	}

	public function pedidosCancelados()
    {
		$dados['pedidos'] = Pedido::where('situacao', 'C')->orderBy('created_at', 'ASC')->get();
		foreach ($dados['pedidos'] as $key => $value) {
			$dados['pedidos'][$key]['detalhes'] = Pedido::pedidoCliente($value->codigoPedido);
		}
		return view('gerenciamento.pedidos_cancelados', $dados);
	}

	public function pedidosEnviados()
    {

		$dados['pedidos'] = Pedido::where('situacao', 'E')->orderBy('created_at', 'ASC')->get();

		foreach ($dados['pedidos'] as $key => $value) {
			$dados['pedidos'][$key]['detalhes'] = Pedido::pedidoCliente($value->codigoPedido);
		}

		return view('gerenciamento.pedidos_enviados', $dados);
	}

	public function pedidosEntregues()
    {
		$dados['pedidos'] = Pedido::where('situacao', 'F')->orderBy('created_at', 'ASC')->get();
		foreach ($dados['pedidos'] as $key => $value) {
			$dados['pedidos'][$key]['detalhes'] = Pedido::pedidoCliente($value->codigoPedido);
		}
		return view('gerenciamento.pedidos_entregues', $dados);
	}

	public function cancelar(Request $request)
	{
		try {
			$pedido = Pedido::find($request->codigoPedido);
			$pedido->situacao = 'C';
			//$pedido->codigoFuncionario = $request->codigoFuncionario;
			$pedido->save();
			$response = array(
				'status' => 'success',
				'msg' => 'Pedido cancelado!'
			);
			return response()->json($response);
		} catch (\Throwable $th) {
			$response = array(
				'status' => 'error',
				'msg' => 'Erro ao cancelar pedido! Tente novamente.'
			);
			return response()->json($response);
		}
	}

	public function entregar(Request $request)
	{
		try {
			$pedido = Pedido::find($request->codigoPedido);
			$pedido->situacao = 'E';
			//$pedido->codigoFuncionario = $request->codigoFuncionario;
			$pedido->save();
			$response = array(
				'status' => 'success',
				'msg' => 'Pedido saiu para entrega!'
            );
            Notification::send(Cliente::find($pedido->codigoCliente),new PushPedidoCliente);
			return response()->json($response);
		} catch (\Throwable $th) {
			$response = array(
				'status' => 'error',
				'msg' => 'Erro ao atualizar situação do pedido! Tente novamente.'
			);
			return response()->json($response);
		}
	}

	public function fechar(Request $request)
	{
		try {
			$pedido = Pedido::find($request->codigoPedido);
			$pedido->situacao = 'F';
			//$pedido->codigoFuncionario = $request->codigoFuncionario;
			$pedido->save();
			$response = array(
				'status' => 'success',
				'msg' => 'Pedido entregue!'
			);
			return response()->json($response);
		} catch (\Throwable $th) {
			$response = array(
				'status' => 'error',
				'msg' => 'Erro ao atualizar situação do pedido! Tente novamente.'
			);
			return response()->json($response);
		}
	}
}
