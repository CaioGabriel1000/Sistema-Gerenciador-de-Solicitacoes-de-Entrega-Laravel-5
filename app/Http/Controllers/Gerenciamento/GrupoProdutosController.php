<?php

namespace App\Http\Controllers\Gerenciamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GrupoProdutos;
use App\Produto;
use App\Categoria;

class GrupoProdutosController extends Controller
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

	public function index(){
		$grupoProdutos = GrupoProdutos::paginate(10);
		$dados['grupoProdutos'] = $grupoProdutos;
		return view('gerenciamento.grupoprodutos', $dados);
	}

	public function create(){
		$dados['categorias'] = Categoria::all();
		return view('gerenciamento.cadastrar_grupoprodutos', $dados);
	}

	public function edit($id){
		$categorias = Categoria::all();
		$grupoProdutos = GrupoProdutos::find($id);
		$produtos = Produto::where('codigoGrupoProdutos', $id)->get();
		return view('gerenciamento.editar_grupoprodutos', compact('grupoProdutos', 'id', 'categorias', 'produtos'));
	}

	public function store(Request $request){
		$this->validate($request, [
			'nome' => 'required',
			'descricao' => 'required',
			'sku' => 'required',
			'codigoCategoria' => 'required|exists:categoria',
			'nomeSubtipo' => 'required',
			'valorUnitario' => 'required',
			'quantidadeEstoque' => 'required',
		]);

		try {
			$grupoProdutos = new GrupoProdutos();
			$grupoProdutos->nome = $request->input('nome');
			$grupoProdutos->save();
		} catch (\Throwable $th) {
			return redirect('gerenciamento/grupoprodutos/create')->with('error','Erro ao cadastrar grupo de produtos! Tente novamente.');
		}

		try {
			foreach ($request->input('nomeSubtipo') as $key => $subtipo) {
				$produto = new Produto();
				$produto->descricao = $request->input('descricao');
				$produto->sku = $request->input('sku');
				$produto->codigoCategoria = $request->input('codigoCategoria');
				$produto->codigoGrupoProdutos = $grupoProdutos->codigoGrupoProdutos;
				$produto->nome = $grupoProdutos->nome . ' - ' . $subtipo;
				$produto->valorUnitario = $request->input('valorUnitario.' . $key);
				$produto->quantidadeEstoque = $request->input('quantidadeEstoque.' . $key);
				$produto->save();
			}
		} catch (\Throwable $th) {
			return redirect('gerenciamento/grupoprodutos/create')->with('error','Erro ao cadastrar produtos! Tente novamente.');
		}

		if ($request->hasFile('imagemProduto')) {
			$nomeArquivo = "grupo-".md5($grupoProdutos->codigoGrupoProdutos).".png";
			$request->file('imagemProduto')->move(public_path('img/produtos/'), $nomeArquivo);
		} else {
			return redirect('gerenciamento/grupoprodutos/create'.$id.'/edit')->with('error','Erro ao inserir a imagem do grupo de produtos! Tente novamente.');
		}

		return redirect('gerenciamento/grupoprodutos/create')->with('success','Grupo de produtos cadastrado com sucesso!');

	}

	public function update(Request $request, $id){
		$this->validate($request, [
			'nome' => 'required',
			'descricao' => 'required',
			'sku' => 'required',
			'codigoCategoria' => 'required|exists:categoria',
			'nomeSubtipo' => 'required',
			'valorUnitario' => 'required',
			'quantidadeEstoque' => 'required',
		]);

		try {
			$grupoProdutos = GrupoProdutos::find($id);
			$grupoProdutos->nome = $request->input('nome');
			$grupoProdutos->save();
		} catch (\Throwable $th) {
			return redirect('gerenciamento/grupoprodutos/'.$id.'/edit')->with('error','Erro atualizar grupo de produtos! Tente novamente.');
		}

		try {
			foreach ($request->input('codigoProduto') as $key => $codigoProduto) {
				if ($codigoProduto != 'NEW') {
					$produto = Produto::find($codigoProduto);
					$produto->descricao = $request->input('descricao');
					$produto->sku = $request->input('sku');
					$produto->codigoCategoria = $request->input('codigoCategoria');
					$produto->nome = $grupoProdutos->nome . ' - ' . $request->input('nomeSubtipo.' . $key);
					$produto->valorUnitario = $request->input('valorUnitario.' . $key);
					$produto->quantidadeEstoque = $request->input('quantidadeEstoque.' . $key);
					$produto->save();
				} else {
					$produtoNovo = new Produto();
					$produtoNovo->descricao = $request->input('descricao');
					$produtoNovo->sku = $request->input('sku');
					$produtoNovo->codigoCategoria = $request->input('codigoCategoria');
					$produtoNovo->codigoGrupoProdutos = $grupoProdutos->codigoGrupoProdutos;
					$produtoNovo->nome = $grupoProdutos->nome . ' - ' . $request->input('nomeSubtipo.' . $key);
					$produtoNovo->valorUnitario = $request->input('valorUnitario.' . $key);
					$produtoNovo->quantidadeEstoque = $request->input('quantidadeEstoque.' . $key);
					$produtoNovo->save();
				}
			}
		} catch (\Throwable $th) {
			return redirect('gerenciamento/grupoprodutos/'.$id.'/edit')->with('error','Erro ao atualizar produtos! Tente novamente.');
		}

		if ($request->hasFile('imagemProduto')) {
			$nomeArquivo = "grupo-".md5($grupoProdutos->codigoGrupoProdutos).".png";
			$request->file('imagemProduto')->move(public_path('img/produtos/'), $nomeArquivo);
		}

		return redirect('gerenciamento/grupoprodutos/'.$id.'/edit')->with('success','Grupo de produtos atualizado com sucesso!');
	}

	public function destroy($id) {
		$grupoProdutos = GrupoProdutos::find($id);
		try {
			Produto::where('codigoGrupoProdutos',$id)->delete();
			GrupoProdutos::where('codigoGrupoProdutos',$id)->delete();
			if (file_exists("grupo-".md5($grupoProdutos->codigoGrupoProdutos).".png")) {
				unlink("grupo-".md5($grupoProdutos->codigoGrupoProdutos).".png");
			}
			return redirect()->back()->with('success','Grupo de produtos deletado com sucesso!');
		} catch (\Throwable $th) {
			Produto::where('codigoGrupoProdutos', $id)->update(['quantidadeEstoque' => 0]);
			return redirect()->back()->with('error','Não é possível deletar esse grupo de produtos, pois está sendo usado em algum pedido! Portanto a quantidade em estoque foi atualizada para 0.');
		}
	}
}
