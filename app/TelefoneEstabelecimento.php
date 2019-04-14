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
    protected $table = 'telefoneEstabelecimento';

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
