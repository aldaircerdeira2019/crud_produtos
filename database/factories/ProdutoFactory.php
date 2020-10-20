<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Api\Produto;
use App\Api\Categoria;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    $categoria_id = Categoria::pluck('id')->toArray();
    return [
        'categoria_id'      =>  $faker->randomElement($categoria_id),
        'nome'              =>  $faker->words(2, true),
        'descricao'         =>  $faker->realText,
        'valor_a_vista'     =>  $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
        'valor_a_prazo'     =>  $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max =1000),
        'quantidade'        =>  $faker->randomDigit,
    ];
});
