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

/*
|--------------------------------------------------------------------------
| Rotas da Loja
|--------------------------------------------------------------------------
*/

Route::resource('/', 'LojaController');

Route::post('/addCarrinho','LojaController@adicionarCarrinho');

Route::post('/buscar','LojaController@buscarCategoria');

Route::post('/pesquisar','LojaController@pesquisarProduto');

Route::post('/rmvCarrinho','CarrinhoController@removerCarrinho');

Route::resource('/carrinho', 'CarrinhoController');

Route::resource('/cliente', 'ClienteController');

Route::resource('/pedidos', 'PedidoController');

Route::get('/finalizar_pedido', 'PedidoController@finalizarPedido');

Route::post('/addPedidoEntrega','PedidoController@salvarPedidoEntrega');

Route::post('/addPedidoRetirar','PedidoController@salvarPedidoRetirar');

Route::post('/pushGerenciamento','PushGerenciamentoController@store');

/*
|--------------------------------------------------------------------------
| Rotas do Gerenciamento
|--------------------------------------------------------------------------
*/

Route::get('/home', 'Gerenciamento\PedidoController@index');

Route::get('/gerenciamento', 'Gerenciamento\EntrarController@index')->name('funcionario.login');

Route::post('/gerenciamento', 'Gerenciamento\EntrarController@login')->name('funcionario.login.submit');

Route::resource('/gerenciamento/produto', 'Gerenciamento\ProdutoController');

Route::resource('/gerenciamento/categoria', 'Gerenciamento\CategoriaController');

Route::resource('/gerenciamento/funcionario', 'Gerenciamento\FuncionarioController');

Route::resource('/gerenciamento/bairro', 'Gerenciamento\BairroController');

Route::resource('/gerenciamento/cidade', 'Gerenciamento\CidadeController');

Route::resource('/gerenciamento/estabelecimento', 'Gerenciamento\EstabelecimentoController');

Route::resource('/gerenciamento/cliente', 'Gerenciamento\ClienteController');

Route::get('/gerenciamento/pedido', 'Gerenciamento\PedidoController@index');

Route::get('/gerenciamento/pedido/enviados', 'Gerenciamento\PedidoController@pedidosEnviados');

Route::get('/gerenciamento/pedido/entregues', 'Gerenciamento\PedidoController@pedidosEntregues');

Route::get('/gerenciamento/pedido/cancelados', 'Gerenciamento\PedidoController@pedidosCancelados');

Route::post('/cancelarPedido','Gerenciamento\PedidoController@cancelar');

Route::post('/entregarPedido','Gerenciamento\PedidoController@entregar');

Route::post('/finalizarPedido','Gerenciamento\PedidoController@fechar');

Route::resource('/gerenciamento/grupoprodutos', 'Gerenciamento\GrupoProdutosController');
