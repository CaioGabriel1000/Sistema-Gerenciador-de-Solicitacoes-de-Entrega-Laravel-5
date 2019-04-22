<?php

namespace App\Http\Controllers\Gerenciamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Estabelecimento;
use Illuminate\Support\Facades\Storage;

class EstabelecimentoController extends Controller
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
		$id = 1;
		$estabelecimento = Estabelecimento::find($id);
		return view('gerenciamento.editar_estabelecimento', compact('estabelecimento', 'id'));
	}

	public function update(Request $request, $id){
		$this->validate($request, [
			'razaoSocial' => 'required',
			'nomeFantasia' => 'required',
			'cnpj' => 'required',
			'inicioJornadaFuncionamento' => 'required',
			'fimJornadaFuncionamento' => 'required',
			'diasFuncionamento' => 'required',
			'identidadeVisual' => 'required',
		]);
		$estabelecimento = Estabelecimento::find($id);
		$estabelecimento->razaoSocial = $request->get('razaoSocial');
		$estabelecimento->nomeFantasia = $request->get('nomeFantasia');
		$estabelecimento->cnpj = $request->get('cnpj');
		$estabelecimento->inicioJornadaFuncionamento = $request->get('inicioJornadaFuncionamento');
		$estabelecimento->fimJornadaFuncionamento = $request->get('fimJornadaFuncionamento');
		$estabelecimento->diasFuncionamento = $request->get('diasFuncionamento');
		$estabelecimento->identidadeVisual = $request->get('identidadeVisual');

		$arquivo = public_path() . '/css/bootstrap.min.css';

		switch ($request->get('identidadeVisual')) {
			case 'P':
				# P = tema preto
				if(unlink($arquivo)){
					$tema = public_path() . '/css/temas/black.min.css';
					copy($tema, $arquivo);
				} else {
					return redirect('gerenciamento/estabelecimento/')->with('error','Erro ao atualizar o tema do estabelecimento! Tente novamente.');
				}
				break;

			case 'A':
				# A = tema azul
				if(unlink($arquivo)){
					$tema = public_path() . '/css/temas/blue.min.css';
					copy($tema, $arquivo);
				} else {
					return redirect('gerenciamento/estabelecimento/')->with('error','Erro ao atualizar o tema do estabelecimento! Tente novamente.');
				}
				break;
				
			case 'R':
				# R = tema rosa
				if(unlink($arquivo)){
					$tema = public_path() . '/css/temas/pink.min.css';
					copy($tema, $arquivo);
				} else {
					return redirect('gerenciamento/estabelecimento/')->with('error','Erro ao atualizar o tema do estabelecimento! Tente novamente.');
				}
				break;

			case 'V':
				# V = tema vermelho
				if(unlink($arquivo)){
					$tema = public_path() . '/css/temas/red.min.css';
					copy($tema, $arquivo);
				} else {
					return redirect('gerenciamento/estabelecimento/')->with('error','Erro ao atualizar o tema do estabelecimento! Tente novamente.');
				}
				break;
			
			default:
				# G = cinza - padrão
				if(unlink($arquivo)){
					$tema = public_path() . '/css/temas/bootstrap.min.css';
					copy($tema, $arquivo);
				} else {
					return redirect('gerenciamento/estabelecimento/')->with('error','Erro ao atualizar o tema do estabelecimento! Tente novamente.');
				}
				break;
		}
		try {
			$estabelecimento->save();
			return redirect('gerenciamento/estabelecimento/')->with('success','Configurações do estabelecimento atualizado com sucesso!');
		} catch (\Throwable $th) {
			return redirect('gerenciamento/estabelecimento/')->with('error','Erro ao atualizar estabelecimento! Tente novamente.');
		}
	}
}
