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

        $id=Auth::id();
        $product_id=$request['product_id'];


        $product=Cart::where('product_id',$product_id);

//       if ($product){
//           try {
////        $c_product=Cart::select('product_price')->where('product_id',$product_id)->get();
//               $c_product = DB::table('carts')->where('product_id', $product_id)->first();
//               $product_price = $c_product->product_price;
////            dd($product_price);
//               $product->product_qty += $request['product_qty'];      //error
//               $product->total = $request['product_qty'] * $product_price;
//               $product->update();                                    //error
//               return $this->returnSuccess('added successfully',201);
//           }catch (Exception $exception){
////               return $exception->getMessage();
//                return $this->returnError('some thing wrong',500);
//           }
//
//        }
       if($product= product::where('id',$product_id)->first()) {
           try{


               $cart= Cart::create([
               'user_id' => Auth::id(),
               'product_id' => $request['product_id'],
               'product_name' =>$request['product_name'],
               'product_qty' => $request['product_qty'],
               'image' => product::find($request['product_id'])->image,
               'product_price' => $request['product_price'],
              'total' => $request['product_qty'] * $request['product_price'],
//               'total' => Cart::select(DB::raw('sum(jumlah * harga) as total')) - > get(),



               ]);

               return $this->returnSuccess('added to cart successfully',200);

       }catch (\Exception $exception){
                DB::rollBack();
            dd($exception->getMessage());
                return $this->returnError('some thing is wrong',500);

            }
           }

//       else{
//           return response()->json(['status' =>'its not exist']);
//       }
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
