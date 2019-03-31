<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class CarrinhoController extends Controller
{
    public function index(){

		$dados['produtos'] = NULL;
		$dados['valorTotal'] = 0;

		if (session()->has('carrinho')) {

			foreach (session('carrinho') as $codigoProduto => $quantidade) {
				$dados['produtos'][$codigoProduto] = Produto::find($codigoProduto);
				$dados['produtos'][$codigoProduto]['quantidade'] = $quantidade;
				$dados['valorTotal'] += $dados['produtos'][$codigoProduto]->valorUnitario * $quantidade;
			}
		}

		return view('loja.carrinho', $dados);
	}

	public function removerCarrinho(Request $request) {
		
		$chave = "carrinho." . $request->codigoProduto;

		if (session($chave) !== null) {
			session()->forget($chave);
			$response = array(
				'status' => 'success',
				'msg' => 'Produto removido do carrinho!'
			);
			return response()->json($response);
		} else {
			$response = array(
				'status' => 'error',
				'msg' => 'Produto não encontrado no carrinho!'
			);
			return response()->json($response);
		}
		
	}
}
