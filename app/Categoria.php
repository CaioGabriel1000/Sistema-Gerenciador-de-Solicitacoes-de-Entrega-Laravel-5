<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * Tabela que está associada a model.
     *
     * @var string
     */
	protected $table = 'categoria';
	
	protected $primaryKey = 'codigoCategoria';

}
