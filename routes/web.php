<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Rotas da Loja
|--------------------------------------------------------------------------
*/

Route::resource('/', 'LojaController');

Route::post('/addCarrinho','LojaController@adicionarCarrinho');

Route::get('/cliente', function () {
	return view('loja.cliente');
});

Route::get('/carrinho', function () {
	return view('loja.carrinho');
});

Route::get('/pedidos', function () {
	return view('loja.pedidos');
});

Route::get('/finalizar_pedido', function () {
	return view('loja.finalizar_pedido');
});