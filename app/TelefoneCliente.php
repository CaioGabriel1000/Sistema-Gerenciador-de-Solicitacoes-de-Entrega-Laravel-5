<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $telefoneCliente
 * @property int $codigoCliente
 * @property Cliente $cliente
 */
class TelefoneCliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'telefone_cliente';

    /**
     * @var array
     */
    protected $fillable = ['telefoneCliente', 'codigoCliente'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'codigoCliente', 'codigoCliente');
    }
}
