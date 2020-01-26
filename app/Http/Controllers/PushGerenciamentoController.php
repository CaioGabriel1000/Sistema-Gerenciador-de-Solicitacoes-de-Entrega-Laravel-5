<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Funcionario;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Notification;


class PushGerenciamentoController extends Controller
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

    /**
     * Store the PushSubscription.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $funcionario = Auth::user();
        $funcionario->updatePushSubscription($endpoint, $key, $token);

        return response()->json(['success' => true],200);
    }
}
