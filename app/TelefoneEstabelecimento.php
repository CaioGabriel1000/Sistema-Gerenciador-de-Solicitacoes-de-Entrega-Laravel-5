<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $telefoneEstabelecimento
 * @property int $codigoEstabelecimento
 * @property Estabelecimento $estabelecimento
 */
class TelefoneEstabelecimento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'telefone_estabelecimento';

    /**
     * @var array
     */
    protected $fillable = ['telefoneEstabelecimento', 'codigoEstabelecimento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estabelecimento()
    {
        return $this->belongsTo('App\Estabelecimento', 'codigoEstabelecimento', 'codigoEstabelecimento');
    }
}
