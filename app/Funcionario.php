<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NotificationChannels\WebPush\HasPushSubscriptions;

/**
 * @property int $codigoFuncionario
 * @property string $name
 * @property string $email
 * @property string $password
 * @property boolean $administrador
 * @property string $situacao
 * @property string $remember_token
 * @property int $codigoEstabelecimento
 * @property string $created_at
 * @property string $updated_at
 * @property Estabelecimento $estabelecimento
 * @property Pedido[] $pedidos
 */
class Funcionario extends Authenticatable
{

    use Notifiable;
    use HasPushSubscriptions;

	protected $guard = 'funcionarioWeb';

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
    protected $fillable = ['name', 'email', 'password', 'administrador', 'situacao', 'remember_token', 'codigoEstabelecimento', 'created_at', 'updated_at'];

	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
    public function pedidos()
    {
        return $this->hasMany('App\Pedido', 'codigoFuncionario', 'codigoFuncionario');
    }
}
