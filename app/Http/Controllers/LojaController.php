<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;

class LojaController extends Controller
{

    public function index(){

		$produtos = Produto::paginate(6);

		$dados['produtos'] = $produtos;

		return view('loja', $dados);
	}

	public function adicionarCarrinho(Request $request) {
		
		$chave = "carrinho." . $request->codigoProduto;

		try {
			if (session($chave) !== null) {
				$novaQuantidade = session($chave) + $request->quantidade;
				session([$chave => $novaQuantidade]);
				$response = array(
					'status' => 'success',
					'msg' => 'Quantidade adicionada ao carrinho!',
					'vlr' => session('carrinho')
				);
				return response()->json($response);
			} else {
				session([$chave => $request->quantidade]);
				$response = array(
					'status' => 'success',
					'msg' => 'Produto adicionado ao carrinho!',
					'vlr' => session('carrinho')
				);
				return response()->json($response);
			}
		} catch (\Throwable $th) {
			$response = array(
				'status' => 'error',
				'msg' => 'Ocorreu um erro, por favor contate o estabelecimento para que seja corrigido!',
				'vlr' => $th
			);
			return response()->json($response);
		}
	}
}
