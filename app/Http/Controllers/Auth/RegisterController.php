<?php

namespace App\Http\Controllers\Auth;

use App\Cliente;
use App\TelefoneCliente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/cliente';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:cliente'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'telefone' => ['required', 'numeric', 'max:99999999999', 'min:10000000'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Cliente
     */
    protected function create(array $data)
    {
		$cliente = new Cliente();
		$telefone = new TelefoneCliente();
        $cliente = Cliente::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'situacao' => 'A',
		]);
		$telefone = TelefoneCliente::create([
			'telefoneCliente' => $data['telefone'],
			'codigoCliente' => $cliente->codigoCliente
		]);
		return $cliente;
    }
}
