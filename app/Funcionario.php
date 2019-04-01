<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoFuncionario
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property string $remember_token
 * @property boolean $administrador
 * @property string $criacao
 * @property string $atualizacao
 * @property int $codigoEstabelecimento
 * @property Estabelecimento $estabelecimento
 * @property TelefoneFuncionario[] $telefoneFuncionarios
 */
class Funcionario extends Model
{
	public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'funcionario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoFuncionario';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'email', 'senha', 'remember_token', 'administrador', 'criacao', 'atualizacao', 'codigoEstabelecimento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estabelecimento()
    {
        return $this->belongsTo('App\Estabelecimento', 'codigoEstabelecimento', 'codigoEstabelecimento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function telefoneFuncionarios()
    {
        return $this->hasMany('App\TelefoneFuncionario', 'codigoFuncionario', 'codigoFuncionario');
    }
}
