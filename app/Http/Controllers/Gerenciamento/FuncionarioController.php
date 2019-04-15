<?php

namespace App\Http\Controllers\Gerenciamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Funcionario;

class FuncionarioController extends Controller
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
		$funcionarios = Funcionario::paginate(10);
		$dados['funcionarios'] = $funcionarios;
		return view('gerenciamento.funcionarios', $dados);
	}

	public function create(){
		return view('gerenciamento.cadastrar_funcionario');
	}

	public function edit($id){
		$funcionario = funcionario::find($id);
		return view('gerenciamento.editar_funcionario', compact('funcionario', 'id'));
	}

	public function store(Request $request){
		$this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:funcionario'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'administrador' => ['required'],
        ]);
		$funcionario = new Funcionario();
		$funcionario->name = $request->input('name');
		$funcionario->email = $request->input('email');
		$funcionario->password = Hash::make($request->input('password'));
		$funcionario->situacao = 'A';
		$funcionario->administrador = $request->input('administrador');
		try {
			$funcionario->save();
			return redirect('gerenciamento/funcionario/create')->with('success','Funcionario cadastrado com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/funcionario/create')->with('error','Erro ao cadastrar funcionario! Tente novamente.');
		}
	}

	public function update(Request $request, $id){
		$this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'administrador' => ['required'],
			'situacao' => ['required'],
        ]);
		$funcionario = funcionario::find($id);
		$funcionario->name = $request->input('name');
		$funcionario->email = $request->input('email');
		$funcionario->password = Hash::make($request->input('password'));
		$funcionario->situacao = $request->input('situacao');
		$funcionario->administrador = $request->input('administrador');
		try {
			$funcionario->save();
			return redirect('gerenciamento/funcionario/'.$id.'/edit')->with('success','Funcionario atualizado com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/funcionario/'.$id.'/edit')->with('error','Erro ao atualizar funcionario! Tente novamente.');
		}
	}

	public function destroy($id) {
		$funcionario = Funcionario::find($id);
		try {
			$funcionario->delete();
			return redirect()->back()->with('success','Funcionario deletado com sucesso!');
		} catch (\Throwable $th) {
			$funcionario->situacao = 'I';
			$funcionario->save();
			return redirect()->back()->with('error','Não é possível deletar esse funcionario, pois ele já atendeu pedidos. Portanto sua situação foi atualizada para inativo!');
		}
	}
}
