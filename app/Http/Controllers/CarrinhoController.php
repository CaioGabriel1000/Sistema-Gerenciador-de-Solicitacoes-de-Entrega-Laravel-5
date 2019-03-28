<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class CarrinhoController extends Controller
{
    public function index(){

		$dados['produtos'] = [];
		$dados['valorTotal'] = 0;

		foreach (session('carrinho') as $codigoProduto => $quantidade) {
			$dados['produtos'][$codigoProduto] = Produto::find($codigoProduto);
			$dados['produtos'][$codigoProduto]['quantidade'] = $quantidade;
			$dados['valorTotal'] += $dados['produtos'][$codigoProduto]->valorUnitario * $quantidade;
		}

		return view('loja.carrinho', $dados);
	}
}
