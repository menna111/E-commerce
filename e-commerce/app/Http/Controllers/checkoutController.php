<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\client;
use App\Models\order;
use App\Models\product;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class checkoutController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $id=Auth::id();
        $products=Cart::where('user_id',$id)->get();
        return view('checkout',compact('products'));
    }

    public function placeOrder(Request $request){
        //validation
        $validator=Validator::make($request->all(),[
            'fname'        => 'required|string|min:3|max:255',
            'lname'        => 'required|string|min:3|max:255',
            'country'        => 'required|string|min:3|max:255',
            'town'        => 'required|string|min:3|max:255',
            'streetadress1'        => 'required|string|min:3|max:255',
            'streetadress2'        => 'required|string|min:3|max:255',
            'product_name'        => 'required|string|min:3|max:255',
            'postcode'      => 'required|numeric',
            'phone'      => 'required|numeric',
            'qty'      => 'required|numeric',
            'price'      => 'required|numeric',

        ]);

        if ($validator->fails()){
            return $this->returnError($validator->errors()->all(),400);
        }



        DB::beginTransaction();
        try{
            $client=  client::create([
                'user_id' => Auth::id(),
                'fname' => $request['fname'],
                'lname'  => $request['lname'],
                'country'  => $request['country'],
                'town'  => $request['town'],
                'streetadress1'  => $request['streetadress1'],
                'streetadress2'  => $request['streetadress2'],
                'postcode'  => $request['postcode'],
                'phone' =>$request['phone'],
            ]);
            $products=Cart::where('user_id',Auth::id())->get();
            foreach ($products as $product) {
                order::create([
                    'client_id' => $client->id,
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'qty' => $product->product_qty,
                    'price' => $product->product_price,
                ]);
                $prod=product::whereId($product->product_id)->first();
                $prod->qty=$prod->qty - $product->product_qty;
                $prod->save();
            }
            $products=Cart::where('user_id',Auth::id())->get();
            Cart::destroy($products);
            DB::commit();
        return $this->returnSuccess('order placed successfully',201);
        }catch (\Exception $exception){
            DB::rollBack();
//            return  $this->returnError($exception->getMessage(),500);
            return  $this->returnError('حدث خطأ ما برجاء المحاولة لاحقا',500);

        }

    }
}
