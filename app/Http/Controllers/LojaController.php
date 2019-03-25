<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;

class LojaController extends Controller
{
    public function index(){

		$produtos = Produto::paginate(6);
		$categoria;

		foreach($produtos as $p) {
			$categoria = Categoria::find($p['codigoCategoria']);
			$p['nomeCategoria'] = $categoria['nome'];
		}

		$dados['produtos'] = $produtos;

		return view('home', $dados);
	}

	public function adicionarCarrinho(Request $request) {

	}
}
