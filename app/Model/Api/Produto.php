<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['categoria_id','nome','descricao','valor_a_vista','valor_a_prazo','quantidade'];
}
