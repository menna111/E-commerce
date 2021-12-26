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

class CartController extends Controller
{
    use ResponseTrait,ImageUpload;
    public function index()
    {
        $id=Auth::id();
        $products=Cart::where('user_id',$id)->get();
        return view('cart',compact('products'));
    }

    public function add(Request $request){
        $id=Auth::id();
        $product_id=$request['product_id'];

       if($product= product::where('id',$product_id)->first()) {
           try{

           Cart::create([
               'user_id' => Auth::id(),
               'product_id' => $request['product_id'],
               'product_name' =>$request['product_name'],
               'product_qty' => $request['product_qty'],
               'image' => product::find($request['product_id'])->image,
               'product_price' => $request['product_price']


           ]);

               return $this->returnSuccess('added to cart successfully',200);

       }catch (\Exception $exception){
                DB::rollBack();
//            dd($exception->getMessage());
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
} //end of class
