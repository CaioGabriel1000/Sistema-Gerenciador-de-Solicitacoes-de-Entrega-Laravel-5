<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoProduto
 * @property string $nome
 * @property string $descricao
 * @property string $sku
 * @property float $valorUnitario
 * @property int $quantidadeEstoque
 * @property int $codigoCategoria
 * @property Categoria $categoria
 * @property PedidoProduto[] $pedidoProdutos
 */
class Produto extends Model
{
	public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'produto';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoProduto';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'descricao', 'sku', 'valorUnitario', 'quantidadeEstoque', 'codigoCategoria'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'codigoCategoria', 'codigoCategoria');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidoProdutos()
    {
        return $this->hasMany('App\PedidoProduto', 'codigoProduto', 'codigoProduto');
    }
}
