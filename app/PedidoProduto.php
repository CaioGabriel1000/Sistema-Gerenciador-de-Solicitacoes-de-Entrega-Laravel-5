<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoProduto
 * @property int $codigoPedido
 * @property int $quantidade
 * @property Produto $produto
 * @property Pedido $pedido
 */
class PedidoProduto extends Model
{
	public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pedido_produto';

    /**
     * @var array
     */
    protected $fillable = ['codigoProduto', 'codigoPedido', 'quantidade'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produto()
    {
        return $this->belongsTo('App\Produto', 'codigoProduto', 'codigoProduto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pedido()
    {
        return $this->belongsTo('App\Pedido', 'codigoPedido', 'codigoPedido');
    }
}
