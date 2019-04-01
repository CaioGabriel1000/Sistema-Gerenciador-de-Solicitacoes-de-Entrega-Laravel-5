<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoEstabelecimento
 * @property string $razaoSocial
 * @property string $nomeFantasia
 * @property integer $cnpj
 * @property int $inicioJornadaFuncionamento
 * @property int $fimJornadaFuncionamento
 * @property int $diasFuncionamento
 * @property string $identidadeVisual
 * @property Entregador[] $entregadors
 * @property Funcionario[] $funcionarios
 * @property TelefoneEstabelecimento[] $telefoneEstabelecimentos
 */
class Estabelecimento extends Model
{
	public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'estabelecimento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoEstabelecimento';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['razaoSocial', 'nomeFantasia', 'cnpj', 'inicioJornadaFuncionamento', 'fimJornadaFuncionamento', 'diasFuncionamento', 'identidadeVisual'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entregadors()
    {
        return $this->hasMany('App\Entregador', 'codigoEstabelecimento', 'codigoEstabelecimento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function funcionarios()
    {
        return $this->hasMany('App\Funcionario', 'codigoEstabelecimento', 'codigoEstabelecimento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function telefoneEstabelecimentos()
    {
        return $this->hasMany('App\TelefoneEstabelecimento', 'codigoEstabelecimento', 'codigoEstabelecimento');
    }
}
