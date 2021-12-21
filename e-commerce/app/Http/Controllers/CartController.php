<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add(Request $request){

        $product_id=$request['product_id'];
       if($product= product::where('id',$product_id)->first()){

           Cart::create([
               'user_id' =>Auth::id(),
               'product_id' =>$request['product_id'],
               'product_qty'  =>$request['product_qty']
           ]);
           return response()->json(['status' => $product->name. 'Added to cart']);

       }else{
           return response()->json(['status' =>'its not exist']);
       }
    }
} //end of class
