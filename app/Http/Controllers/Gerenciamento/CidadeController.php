<?php

namespace App\Http\Controllers\Gerenciamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cidade;

class CidadeController extends Controller
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
		$cidades = Cidade::paginate(10);
		$dados['cidades'] = $cidades;
		return view('gerenciamento.cidades', $dados);
	}

	public function create(){
		return view('gerenciamento.cadastrar_cidade');
	}

	public function edit($id){
		$cidade = Cidade::find($id);
		return view('gerenciamento.editar_cidade', compact('cidade', 'id'));
	}

	public function store(Request $request){
		$this->validate($request, [
			'nome' => 'required',
			'valorFrete' => 'required|numeric'
		]);
		$cidade = new Cidade();
		$cidade->nome = $request->input('nome');
		$cidade->valorFrete = $request->input('valorFrete');
		try {
			$cidade->save();
			return redirect('gerenciamento/cidade/create')->with('success','Cidade cadastrada com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/cidade/create')->with('error','Erro ao cadastrar cidade! Tente novamente.');
		}
	}

	public function update(Request $request, $id){
		$this->validate($request, [
			'nome' => 'required',
			'valorFrete' => 'required|numeric'
		]);
		$cidade = Cidade::find($id);
		$cidade->nome = $request->get('nome');
		$cidade->valorFrete = $request->get('valorFrete');
		try {
			$cidade->save();
			return redirect('gerenciamento/cidade/'.$id.'/edit')->with('success','Cidade atualizada com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/cidade/'.$id.'/edit')->with('error','Erro ao atualizar cidade! Tente novamente.');
		}
	}

	public function destroy($id) {
		$cidade = Cidade::find($id);
		try {
			$cidade->delete();
			return redirect()->back()->with('success','Cidade deletada com sucesso!');
		} catch (\Throwable $th) {
			return redirect()->back()->with('error','Não é possível deletar essa cidade, pois está sendo usada em alguns pedidos.');
		}
	}
}
