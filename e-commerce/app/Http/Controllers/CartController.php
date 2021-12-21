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
//           DB::beginTransaction();
//           if ($request->has('image')) {
//               $image = $this->uploadImage($request->file('image'), 'uploaded/cart/product/' . $id, 50);
//           } else {
//               $image = null;
//           }
           Cart::create([
               'user_id' => Auth::id(),
               'product_id' => $request['product_id'],
               'product_name' =>$request['product_name'],
               'product_qty' => $request['product_qty'],
               'image' => product::find($request['product_id'])->image,
               'product_price' => $request['product_price']


           ]);
//           DB::commit();
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
} //end of class
