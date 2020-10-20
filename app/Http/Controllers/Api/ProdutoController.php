<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Api\Produto;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    private $produto;
    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }
    public function index()
    {
         try {
            $produtos = $this->produto->consulta();
            return response()->json(compact('produtos'));
        } catch (\Exception $e) {
            $erro = $e->getMessage();
            return response()->json(compact('erro'));
        }
    }
    public function show($id)
    {
        /* $produto = $this->produto->find($id); */
        $produto = $this->produto->show($id);
        if(is_null($produto)){
            return response()->json('não encontrado',404);
        }
        return response()->json(compact('produto'),200);
    }
    public function store(Request $request)
    {
        try {
            $rules = [
                'categoria_id'      =>  'required',
                'nome'              =>  'required|min:3|max:120' ,
                'descricao'         =>  "required|min:30",
                'valor_a_vista'     =>  "required|numeric",
                'valor_a_prazo'     =>  "required|numeric",
                'quantidade'        =>  "required|integer",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            $create_produto = $this->produto->create($request->all());
            return response()->json(compact('create_produto'),201);
        }
        catch (\Exception $e) 
        {
            $erro = $e->getMessage();
            return response()->json(compact('erro'),500);
        }
    }
    public function update($id, Request $request)
    {
        $produto= $this->produto->find($id);
         if(is_null($produto)){
            return response()->json('não encontrado',404);
        }
        $rules = [
            'categoria_id'      =>  'required',
            'nome'              =>  'required|min:3|max:120' ,
            'descricao'         =>  "required|min:30",
            'valor_a_vista'     =>  "required|numeric",
            'valor_a_prazo'     =>  "required|numeric",
            'quantidade'        =>  "required|integer",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
         $produto->update($request->all());
         return response()->json(compact('produto'),200);
    }
    public function destroy($id)
    {
        try {
            $produto= $this->produto->find($id);
            if(is_null($produto)){
                return response()->json(['erro'=>'não encontrado']);
            }
            $produto->delete();
            return response()->json(['sucess' => 'executado com êxito']);
        }
        catch (\Exception $e) 
        {
            $erro = $e->getMessage();
            return response()->json(compact('erro'),500);
        }
    }
}
