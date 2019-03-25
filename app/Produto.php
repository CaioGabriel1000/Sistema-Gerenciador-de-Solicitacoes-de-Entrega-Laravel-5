<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /**
     * Tabela que está associada a model.
     *
     * @var string
     */
	protected $table = 'produto';
	
	protected $primaryKey = 'codigoProduto';

}
