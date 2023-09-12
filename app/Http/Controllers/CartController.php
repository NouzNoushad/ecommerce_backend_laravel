<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function getCartList($id=null){
        $cartTable = DB::table('carts');
        $carts = $id ? $cartTable->find($id) : $cartTable->get();
        if($carts){
            return response()->json(['result' => $carts], 200);
        }
        else{
            return response()->json(['result' => 'Cart products not found'], 404);
        }
    }

    public function addOrUpdateCart(Request $request){
        $todoList = DB::table('carts');
        $rules = array(
            'thumbnail' => 'required',
            'title' => 'required',
            'price' => 'required',
            'discountPercentage' => 'required | max:100',
            'rating' => 'required | max:5',
            'stock' => 'required',
            'brand' => 'required',
            'category' => 'nullable',
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 402);
        }
        else{
            $cartTable = DB::table('carts');
                $cartTable->updateOrInsert([
                    'id' => $request->id
                ], [
                    'thumbnail' => $request->thumbnail,
                    'title' => $request->title,
                    'price' => $request->price,
                    'discountPercentage' => $request->discountPercentage,
                    'rating' => $request->rating,
                    'stock' => $request->stock,
                    'brand' => $request->brand,
                    'category' => $request->category,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                if($todoList){
                    return response()->json(['result' => 'Success'], 200);
                }
                else{
                    return response()->json(['result' => 'Cart not found'], 404);
                }
        }
    }

    public function deleteCart(Request $request){
        $cartTable = DB::table('carts');
        $rules = array(
            "id" => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 402);
        }
        else{
            $cart = $cartTable->where('id', $request->id)->delete();
            if($cart){
                    return response()->json(['result' => 'Cart deleted'], 200);
                }
                else{
                    return response()->json(['result' => 'Cart not found'], 404);
                }
        }
    }
}
