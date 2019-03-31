<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoCliente
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property string $situacao
 * @property integer $telefone
 * @property string $remember_token
 * @property string $criacao
 * @property string $atualizacao
 * @property Pedido[] $pedidos
 * @property TelefoneCliente[] $telefoneClientes
 */
class Cliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cliente';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoCliente';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'email', 'senha', 'situacao', 'telefone', 'remember_token', 'criacao', 'atualizacao'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany('App\Pedido', 'codigoCliente', 'codigoCliente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function telefoneClientes()
    {
        return $this->hasMany('App\TelefoneCliente', 'codigoCliente', 'codigoCliente');
    }
}
