<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProducts($id = null){
        $productTable = DB::table('products');
        $products = $id ? $productTable->find($id) : $productTable->get();
        if($products){
            return response()->json(['result' => $products], 200);
        }
        else{
            return response()->json(['result' => 'Products not found'], 404);
        }
    }
}
