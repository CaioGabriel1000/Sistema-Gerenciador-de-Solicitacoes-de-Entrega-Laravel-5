<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $codigoEntregador
 * @property string $nome
 * @property int $inicioJornadaTrabalho
 * @property int $fimJornadaTrabalho
 * @property int $codigoEstabelecimento
 * @property Estabelecimento $estabelecimento
 * @property Entrega[] $entregas
 * @property TelefoneEntregador[] $telefoneEntregadors
 */
class Entregador extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'entregador';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoEntregador';

    /**
     * @var array
     */
    protected $fillable = ['nome', 'inicioJornadaTrabalho', 'fimJornadaTrabalho', 'codigoEstabelecimento'];

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
    public function entregas()
    {
        return $this->hasMany('App\Entrega', 'codigoEntregador', 'codigoEntregador');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function telefoneEntregadors()
    {
        return $this->hasMany('App\TelefoneEntregador', 'codigoEntregador', 'codigoEntregador');
    }
}
