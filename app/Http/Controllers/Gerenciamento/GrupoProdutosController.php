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
		$produtos = Produto::paginate(10);
		$dados['produtos'] = $produtos;
		return view('gerenciamento.grupoprodutos', $dados);
	}

	public function create(){
		$dados['categorias'] = Categoria::all();
		return view('gerenciamento.cadastrar_grupoprodutos', $dados);
	}

	public function edit($id){
		$categorias = Categoria::all();
		$produto = Produto::find($id);
		return view('gerenciamento.editar_produto', compact('produto', 'id', 'categorias'));
	}

	public function store(Request $request){
		$this->validate($request, [
			'nome' => 'required',
			'descricao' => 'required',
			'sku' => 'required',
			'codigoCategoria' => 'required|exists:categoria',
			'tamanhoGrupo' => 'required|min:1'
		]);

		try {
			$grupoProdutos = new GrupoProdutos();
			$grupoProdutos->nome = $request->input('nome');
			$grupoProdutos->save();
		} catch (\Throwable $th) {
			return redirect('gerenciamento/produto/create')->with('error','Erro ao cadastrar grupo de produtos! Tente novamente.');
		}

		$produto = new Produto();
		$produto->descricao = $request->input('descricao');
		$produto->sku = $request->input('sku');
		$produto->codigoCategoria = $request->input('codigoCategoria');
		$produto->codigoGrupoProdutos = $grupoProdutos->codigoGrupoProdutos;

		for ($i=1; $i <= $request->input('tamanhoGrupo'); $i++) {
			try {
				$produto->nome = $grupoProdutos->nome . ' - ' . $request->input('nomeSubtipo' . $i);
				$produto->valorUnitario = $request->input('valorUnitario' . $i);
				$produto->quantidadeEstoque = $request->input('quantidadeEstoque' . $i);
				$produto->save();
			} catch (\Throwable $th) {
				return redirect('gerenciamento/produto/create')->with('error','Erro ao cadastrar produto! Tente novamente.');
			}
		}
		
		try {
			if ($request->hasFile('imagemProduto')) {
				$nomeArquivo = md5($grupoProdutos->codigoGrupoProdutos).".png";
				$request->file('imagemProduto')->move(public_path('img/produtos/'), $nomeArquivo);
			} else {
				return redirect('gerenciamento/produto/create'.$id.'/edit')->with('error','Erro ao inserir a imagem do produto! Tente novamente.');
			}
			return redirect('gerenciamento/produto/create')->with('success','Produto cadastrado com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/produto/create')->with('error','Erro ao cadastrar produto! Tente novamente.');
		}
	}

	public function update(Request $request, $id){
		$this->validate($request, [
			'nome' => 'required',
			'descricao' => 'required',
			'sku' => 'required',
			'valorUnitario' => 'required|numeric',
			'quantidadeEstoque' => 'required|integer',
			'codigoCategoria' => 'required|exists:categoria',
		]);
		$produto = Produto::find($id);
		$produto->nome = $request->get('nome');
		$produto->descricao = $request->get('descricao');
		$produto->sku = $request->get('sku');
		$produto->valorUnitario = $request->get('valorUnitario');
		$produto->quantidadeEstoque = $request->get('quantidadeEstoque');
		$produto->codigoCategoria = $request->get('codigoCategoria');
		if ($request->hasFile('imagemProduto')) {
			//$imagem = $request->file('imagemProduto');
			$nomeArquivo = md5($id).".png";
			$request->file('imagemProduto')->move(public_path('img/produtos/'), $nomeArquivo);
		}
		try {
			$produto->save();
			return redirect('gerenciamento/produto/'.$id.'/edit')->with('success','Produto atualizado com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/produto/'.$id.'/edit')->with('error','Erro ao atualizar produto! Tente novamente.');
		}
	}

	public function destroy($id) {
		$produto = Produto::find($id);
		try {
			$produto->delete();
			if (file_exists("img/produtos/".md5($produto->codigoProduto).".png")) {
				unlink("img/produtos/".md5($produto->codigoProduto).".png");
			}
			return redirect()->back()->with('success','Produto deletado com sucesso!');
		} catch (\Throwable $th) {
			$produto->quantidadeEstoque = 0;
			$produto->save();
			return redirect()->back()->with('error','Não é possível deletar esse produto, pois está sendo usado em algum pedido! Portanto a quantidade em estoque foi atualizada para 0.');
		}
	}
}
