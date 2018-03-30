<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    // define campos que podem ser incluidos / alterados na tabela peloas metodos do Laravel

    protected $fillable = array('nome', 'marca', 'quant', 'preco');

    //indica que esta model (tabela produtos) não utiliza os campos
    //create_at e update_at
    public $timestamps = false;
}
