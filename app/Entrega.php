<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoEntrega
 * @property string $situacao
 * @property int $codigoPedido
 * @property int $codigoEndereco
 * @property int $codigoEntregador
 * @property Pedido $pedido
 * @property Endereco $endereco
 * @property Entregador $entregador
 */
class Entrega extends Model
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
    protected $table = 'entrega';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoEntrega';

    /**
     * @var array
     */
    protected $fillable = ['situacao', 'codigoPedido', 'codigoEndereco', 'codigoEntregador'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pedido()
    {
        return $this->belongsTo('App\Pedido', 'codigoPedido', 'codigoPedido');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function endereco()
    {
        return $this->belongsTo('App\Endereco', 'codigoEndereco', 'codigoEndereco');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entregador()
    {
        return $this->belongsTo('App\Entregador', 'codigoEntregador', 'codigoEntregador');
    }
}
