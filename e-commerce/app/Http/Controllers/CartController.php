<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\product;
use App\Traits\ImageUpload;
use App\Traits\ResponseTrait;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class CartController extends Controller
{
    use ResponseTrait,ImageUpload;
    public function index()
    {
        $id=Auth::id();
        $products=Cart::where('user_id',$id)->latest()->get();
        return view('cart',compact('products'));
    }

    public function add(Request $request){
        $product_id=$request['product_id'];
        $product=Cart::where('product_id',$product_id)->first();

       if ($product){
           try {
               $product_price = $product->product_price;
               $product->total = ($request['product_qty'] + $product->product_qty) * $product_price;
               $product->product_qty += $request['product_qty'];
               $product->save();
               return $this->returnSuccess('added successfully',201);
           }catch (Exception $exception){
//               return $exception->getMessage();
                return $this->returnError('some thing wrong',500);
           }

        }

           try{
//           return $this->returnData('request', $request->all(), 200);
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' =>$request['product_id'],
                    'product_name'  =>$request['product_name'],
                    'product_qty'  =>$request['product_qty'],
                    'image'  =>$request['image'],
                    'product_price'  =>$request['product_price'],
                    'total'  =>$request['product_qty'] * $request['product_price'],

                ]);
           }catch (\Exception $exception){
            return $exception->getMessage();
               return $this->returnError('some thing wrong',500);
           }

        return $this->returnSuccess('added successfully',200);
    }

    public function delete($id){

        $product=Cart::whereId($id)->first();
        if (is_null($product) ){
            return $this->returnError('no product with this id',200);
        }
        $product->delete();
        return $this->returnSuccess('deleted',200);
    }


    public function update(Request $request){
//        dd($request['p_price'] * $request['p_qty']);

//        return $this->returnData('ss', $request->all(), 200);
        if($cart=Cart::whereId($request['id'])->where('user_id',Auth::id())->first()) {
            $cart->product_qty = $request['p_qty'];
            $cart->total = $request['p_qty'] * $request['p_price'];



            $cart->save();
            return $this->returnSuccess('quantity updated',201);
        }else{
            return $this->returnError('no product',500);
        }
    }



} //end of class
