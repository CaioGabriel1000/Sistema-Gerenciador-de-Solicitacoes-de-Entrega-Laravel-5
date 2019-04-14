<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoCidade
 * @property string $nome
 * @property string $estado
 * @property float $valorFrete
 * @property Bairro[] $bairros
 */
class Cidade extends Model
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
    protected $table = 'cidade';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoCidade';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'estado', 'valorFrete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bairros()
    {
        return $this->hasMany('App\Bairro', 'codigoCidade', 'codigoCidade');
    }
}
