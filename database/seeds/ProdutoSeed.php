<?php

use Illuminate\Database\Seeder;
use App\Model\Api\Produto;

class ProdutoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Produto::class,30)->create();
    }
}
