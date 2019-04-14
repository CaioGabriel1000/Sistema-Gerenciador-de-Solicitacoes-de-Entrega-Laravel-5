<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoEndereco
 * @property string $logradouro
 * @property string $numero
 * @property string $complemento
 * @property int $cep
 * @property int $codigoBairro
 * @property Bairro $bairro
 * @property Entrega[] $entregas
 */
class Endereco extends Model
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
    protected $table = 'endereco';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoEndereco';

    /**
     * @var array
     */
    protected $fillable = ['logradouro', 'numero', 'complemento', 'cep', 'codigoBairro'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bairro()
    {
        return $this->belongsTo('App\Bairro', 'codigoBairro', 'codigoBairro');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entregas()
    {
        return $this->hasMany('App\Entrega', 'codigoEndereco', 'codigoEndereco');
    }
}
