<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['categoria' ];
    public $timestamps = false;
}
