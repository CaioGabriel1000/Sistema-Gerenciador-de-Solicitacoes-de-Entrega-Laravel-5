<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $telefoneFuncionario
 * @property int $codigoFuncionario
 * @property Funcionario $funcionario
 */
class TelefoneFuncionario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'telefone_funcionario';

    /**
     * @var array
     */
    protected $fillable = ['telefoneFuncionario', 'codigoFuncionario'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario', 'codigoFuncionario', 'codigoFuncionario');
    }
}
