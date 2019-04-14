<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;

class LojaController extends Controller
{

    public function index(){

		$produtos = Produto::where('quantidadeEstoque', '>', 0)->paginate(6);

		$dados['produtos'] = $produtos;

		return view('loja', $dados);
	}

	public function adicionarCarrinho(Request $request) {
		
		$chave = "carrinho." . $request->codigoProduto;

		try {
			$produto = Produto::find($request->codigoProduto);
			if (session($chave) !== null) {
				$novaQuantidade = session($chave) + $request->quantidade;
				if ($novaQuantidade > $produto->quantidadeEstoque) {
					$response = array(
						'status' => 'success',
						'msg' => 'Não é possível adicionar essa quantidade desse produto ao carrinho! A quantidade máxima é '.$produto->quantidadeEstoque,
						//'vlr' => session('carrinho')
					);
					return response()->json($response);
				}
				session([$chave => $novaQuantidade]);
				$response = array(
					'status' => 'success',
					'msg' => 'Quantidade adicionada ao carrinho!',
					//'vlr' => session('carrinho')
				);
				return response()->json($response);
			} else {
				if ($request->quantidade > $produto->quantidadeEstoque) {
					$response = array(
						'status' => 'success',
						'msg' => 'Não é possível adicionar essa quantidade desse produto ao carrinho! A quantidade máxima é '.$produto->quantidadeEstoque,
						//'vlr' => session('carrinho')
					);
					return response()->json($response);
				}
				session([$chave => $request->quantidade]);
				$response = array(
					'status' => 'success',
					'msg' => 'Produto adicionado ao carrinho!',
					//'vlr' => session('carrinho')
				);
				return response()->json($response);
			}
		} catch (\Throwable $th) {
			$response = array(
				'status' => 'error',
				'msg' => 'Ocorreu um erro ao adicionar o produto ao carrinho, por favor contate o estabelecimento para que seja corrigido!',
				//'vlr' => $th
			);
			return response()->json($response);
		}
	}
}
