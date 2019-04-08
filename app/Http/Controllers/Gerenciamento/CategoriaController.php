<?php

namespace App\Http\Controllers\Gerenciamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categoria;

class CategoriaController extends Controller
{
	public function index(){
		$categorias = Categoria::paginate(10);
		$dados['categorias'] = $categorias;
		return view('gerenciamento.categorias', $dados);
	}

	public function create(){
		return view('gerenciamento.cadastrar_categoria');
	}

	public function edit($id){
		$categoria = Categoria::find($id);
		return view('gerenciamento.editar_categoria', compact('categoria', 'id'));
	}

	public function store(Request $request){
		$this->validate($request, [
			'nome' => 'required',
		]);
		$categoria = new Categoria();
		$categoria->nome = $request->input('nome');
		try {
			$categoria->save();
			return redirect('gerenciamento/categoria/create')->with('success','Categoria cadastrada com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/categoria/create')->with('error','Erro ao cadastrar categoria! Tente novamente.');
		}
	}

	public function update(Request $request, $id){
		$this->validate($request, [
			'nome' => 'required',
		]);
		$categoria = Categoria::find($id);
		$categoria->nome = $request->get('nome');
		try {
			$categoria->save();
			return redirect('gerenciamento/categoria/'.$id.'/edit')->with('success','Categoria atualizada com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/categoria/'.$id.'/edit')->with('error','Erro ao atualizar categoria! Tente novamente.');
		}
	}

	public function destroy($id) {
		$categoria = Categoria::find($id);
		try {
			$categoria->delete();
			return redirect()->back()->with('success','Categoria deletada com sucesso!');
		} catch (\Throwable $th) {
			return redirect()->back()->with('error','Não é possível deletar essa categoria, pois está sendo usada em alguns produtos.');
		}
	}
}
