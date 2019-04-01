<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $telefoneEntregador
 * @property int $codigoEntregador
 * @property Entregador $entregador
 */
class TelefoneEntregador extends Model
{
	public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'telefone_entregador';

    /**
     * @var array
     */
    protected $fillable = ['telefoneEntregador', 'codigoEntregador'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entregador()
    {
        return $this->belongsTo('App\Entregador', 'codigoEntregador', 'codigoEntregador');
    }
}
