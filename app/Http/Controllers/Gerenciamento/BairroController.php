<?php

namespace App\Http\Controllers\Gerenciamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bairro;
use App\Cidade;

class BairroController extends Controller
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
		$bairros = Bairro::paginate(10);
		$dados['bairros'] = $bairros;
		return view('gerenciamento.bairros', $dados);
	}

	public function create(){
		$cidades = Cidade::all();
		$dados['cidades'] = $cidades;
		return view('gerenciamento.cadastrar_bairro', $dados);
	}

	public function edit($id){
		$bairro = Bairro::find($id);
		$cidades = Cidade::all();
		return view('gerenciamento.editar_bairro', compact('bairro', 'id', 'cidades'));
	}

	public function store(Request $request){
		$this->validate($request, [
			'nome' => 'required',
			'codigoCidade' => 'required|exists:cidade',
			'valorFrete' => 'required|numeric',
		]);
		$bairro = new Bairro();
		$bairro->nome = $request->input('nome');
		$bairro->codigoCidade = $request->input('codigoCidade');
		$bairro->valorFrete = $request->input('valorFrete');
		try {
			$bairro->save();
			return redirect('gerenciamento/bairro/create')->with('success','Bairro cadastrado com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/bairro/create')->with('error','Erro ao cadastrar bairro! Tente novamente.');
		}
	}

	public function update(Request $request, $id){
		$this->validate($request, [
			'nome' => 'required',
			'codigoCidade' => 'required|exists:cidade',
			'valorFrete' => 'required|numeric',
		]);
		$bairro = Bairro::find($id);
		$bairro->nome = $request->input('nome');
		$bairro->codigoCidade = $request->input('codigoCidade');
		$bairro->valorFrete = $request->input('valorFrete');
		try {
			$bairro->save();
			return redirect('gerenciamento/bairro/'.$id.'/edit')->with('success','Bairro atualizado com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/bairro/'.$id.'/edit')->with('error','Erro ao atualizar bairro! Tente novamente.');
		}
	}

	public function destroy($id) {
		$bairro = Bairro::find($id);
		try {
			$bairro->delete();
			return redirect()->back()->with('success','Bairro deletado com sucesso!');
		} catch (\Throwable $th) {
			return redirect()->back()->with('error','Não é possível deletar esse bairro, pois está sendo usado em alguns pedidos.');
		}
	}
}
