<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Api\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
         try {
            $categoria = Categoria::all();
            return response()->json(compact('categoria'));
        } catch (\Exception $e) {
            $erro = $e->getMessage();
            return response()->json(compact('erro'));
        }
    }
}
