<?php

namespace App\Http\Controllers\Gerenciamento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Funcionario;
use Auth;

class EntrarController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:funcionarioWeb');
    }

	public function index(){
		return view('gerenciamento.entrar');
	}

	public function login(Request $request){
		$this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
			'password' => ['required', 'string', 'min:8'],
		]);
		
		if (Auth::guard('funcionarioWeb')->attempt(
			['email' => $request->email, 'password' => $request->password],
			$request->remember)
		)
		{
			return redirect()->intended('/gerenciamento/pedido/');
		}

		return redirect()->back();
	}

}
