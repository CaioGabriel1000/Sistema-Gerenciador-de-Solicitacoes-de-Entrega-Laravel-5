<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoGrupoProdutos
 * @property string $nome
 * @property Produto[] $produtos
 */
class GrupoProdutos extends Model
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
    protected $table = 'grupoProdutos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoGrupoProdutos';

    /**
     * @var array
     */
    protected $fillable = ['nome'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produtos()
    {
        return $this->hasMany('App\Produto', 'codigoGrupoProdutos', 'codigoGrupoProdutos');
    }
}
