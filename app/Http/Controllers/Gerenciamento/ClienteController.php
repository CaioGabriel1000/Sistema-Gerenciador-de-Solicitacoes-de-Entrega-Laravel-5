<?php

namespace App\Http\Controllers\Gerenciamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;

class ClienteController extends Controller
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
		$clientes = Cliente::paginate(10);
		$dados['clientes'] = $clientes;
		return view('gerenciamento.clientes', $dados);
	}

	public function update(Request $request, $codigoCliente){
		$this->validate($request, [
			'situacao' => 'required',
		]);
		$cliente = Cliente::find($codigoCliente);
		$cliente->situacao = $request->get('situacao');
		$cliente->remember_token = NULL;
		try {
			$cliente->save();
			return redirect('gerenciamento/cliente')->with('success','Cliente atualizado com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/cliente')->with('error','Erro ao atualizar cliente! Tente novamente.');
		}
	}
}
