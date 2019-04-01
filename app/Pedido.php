<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $codigoPedido
 * @property float $valorTotal
 * @property string $formaPagamento
 * @property string $observacoes
 * @property string $situacao
 * @property string $criacao
 * @property string $atualizacao
 * @property int $codigoCliente
 * @property Cliente $cliente
 * @property Entrega[] $entregas
 * @property Pagamento[] $pagamentos
 * @property PedidoProduto[] $pedidoProdutos
 */
class Pedido extends Model
{
	public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pedido';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoPedido';

    /**
     * @var array
     */
    protected $fillable = ['valorTotal', 'formaPagamento', 'observacoes', 'situacao', 'criacao', 'atualizacao', 'codigoCliente'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'codigoCliente', 'codigoCliente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entregas()
    {
        return $this->hasMany('App\Entrega', 'codigoPedido', 'codigoPedido');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagamentos()
    {
        return $this->hasMany('App\Pagamento', 'codigoPedido', 'codigoPedido');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidoProdutos()
    {
        return $this->hasMany('App\PedidoProduto', 'codigoPedido', 'codigoPedido');
	}
	
	public static function pedidoCliente(int $codigoPedido)
	{
		return DB::table('pedido')
		->join('pedido_produto', 'pedido.codigoPedido', '=', 'pedido_produto.codigoPedido')
		->join('produto', 'pedido_produto.codigoProduto', '=', 'produto.codigoProduto')
		->join('entrega', 'pedido.codigoPedido', '=', 'entrega.codigoPedido')
		->join('endereco', 'entrega.codigoEndereco', '=', 'endereco.codigoEndereco')
		->join('bairro', 'bairro.codigoBairro', '=', 'endereco.codigoBairro')
		->join('cidade', 'cidade.codigoCidade', '=', 'bairro.codigoCidade')
		->select('pedido.codigoPedido',
			'pedido_produto.codigoProduto',
			'pedido_produto.quantidade',
			'produto.nome as produto',
			'produto.valorUnitario',
			'entrega.situacao',
			'endereco.*',
			'bairro.nome as bairro',
			'cidade.nome as cidade')
		->where('pedido.codigoPedido', '=', $codigoPedido)
		->get();
	}
}
