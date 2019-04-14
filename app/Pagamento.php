<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoPagamento
 * @property float $valor
 * @property string $situacao
 * @property int $codigoPedido
 * @property Pedido $pedido
 */
class Pagamento extends Model
{
	/**
     * Enable or disable timestamps for the model.
     * 
     * @var boolean
     */
	public $timestamps = false;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pagamento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoPagamento';

    /**
     * @var array
     */
    protected $fillable = ['valor', 'situacao', 'codigoPedido'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pedido()
    {
        return $this->belongsTo('App\Pedido', 'codigoPedido', 'codigoPedido');
    }
}
