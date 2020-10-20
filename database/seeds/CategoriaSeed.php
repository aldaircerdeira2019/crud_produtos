<?php

use Illuminate\Database\Seeder;

class CategoriaSeed extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            [
                'categoria' => 'Áudio',
            ],
            [
                'categoria' => 'Bebidas',
            ],
            [
                'categoria' => 'Calçados',
            ],
            [
                'categoria' => 'Casa e Construção',
            ],
            [
                'categoria' => 'Eletrodomésticos',
            ],
            [
                'categoria' => 'Móveis',
            ],
            [
                'categoria' => 'Produtos de Limpeza',
            ],
            [
                'categoria' => 'Utilidades Domésticas',
            ],
        ]);
    }
}