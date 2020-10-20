<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['categoria_id','nome','descricao','valor_a_vista','valor_a_prazo','quantidade'];

    public function consulta(){
        $dados = 
            $this
            ->join('categorias','categorias.id', '=', 'produtos.categoria_id')
            ->select('categorias.categoria', "produtos.*")
            ->orderBy('id', 'desc')
            ->paginate(20);
        return $dados;
    }
    public function show($id){
        $dados = 
            $this
            ->where('produtos.id', $id)
            ->join('categorias','categorias.id', '=', 'produtos.categoria_id')
            ->select('categorias.categoria', "produtos.*")
            ->first();
        return $dados;
    }
}
