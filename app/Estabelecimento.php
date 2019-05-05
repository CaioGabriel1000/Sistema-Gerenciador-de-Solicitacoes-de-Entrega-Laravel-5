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
    protected $table = 'estabelecimento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'codigoEstabelecimento';

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

	/**
	 * Transform hours like "1:45" into the total number of minutes, "105"
	 * 
     * @return int
     */
	function hoursToMinutes($hours) { 
		$minutes = 0;
		if (strpos($hours, ':') !== false) {
			// Split hours and minutes.
			list($hours, $minutes) = explode(':', $hours);
		}
		return $hours * 60 + $minutes;
	}

	/**
	 * Transform hours like "1:45" into the total number of minutes, "105"
	 * 
     * @return string
     */
	function minutesToHours($minutes) {
		$hours = (int)($minutes / 60);
		$minutes -= $hours * 60;
		return sprintf("%d:%02.0f", $hours, $minutes);
	}
}
