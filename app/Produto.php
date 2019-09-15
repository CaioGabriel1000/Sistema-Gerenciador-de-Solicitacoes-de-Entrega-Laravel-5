<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoProduto
 * @property string $nome
 * @property string $sku
 * @property float $valorUnitario
 * @property int $quantidadeEstoque
 * @property string $descricao
 * @property int $codigoCategoria
 * @property int $codigoGrupoProdutos
 * @property Categoria $categoria
 * @property GrupoProdutos $grupoProdutos
 * @property PedidoProduto[] $pedidoProdutos
 */
class Produto extends Model
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
    protected $fillable = ['nome', 'sku', 'valorUnitario', 'quantidadeEstoque', 'descricao', 'codigoCategoria'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'codigoCategoria', 'codigoCategoria');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grupoProdutos()
    {
        return $this->belongsTo('App\GrupoProdutos', 'codigoGrupoProdutos', 'codigoGrupoProdutos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidoProdutos()
    {
        return $this->hasMany('App\PedidoProduto', 'codigoProduto', 'codigoProduto');
    }
}
