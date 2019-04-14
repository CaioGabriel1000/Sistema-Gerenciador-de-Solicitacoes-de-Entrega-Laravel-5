<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoBairro
 * @property string $nome
 * @property float $valorFrete
 * @property int $codigoCidade
 * @property Cidade $cidade
 * @property Endereco[] $enderecos
 */
class Bairro extends Model
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
    protected $table = 'bairro';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoBairro';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'valorFrete', 'codigoCidade'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cidade()
    {
        return $this->belongsTo('App\Cidade', 'codigoCidade', 'codigoCidade');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enderecos()
    {
        return $this->hasMany('App\Endereco', 'codigoBairro', 'codigoBairro');
    }
}
