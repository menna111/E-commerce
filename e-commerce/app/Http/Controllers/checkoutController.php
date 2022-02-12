<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahServices;
use App\Models\Cart;
use App\Models\client;
use App\Models\order;
use App\Models\order_item;
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
    private $fatoorahServices;
    public function __construct(FatoorahServices $fatoorahServices){
        $this->fatoorahServices=$fatoorahServices;
    }

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
            $order= order::create([
                'user_id' => Auth::id(),
                'fname' => $request['fname'],
                'lname'  => $request['lname'],
                'country'  => $request['country'],
                'town'  => $request['town'],
                'streetadress1'  => $request['streetadress1'],
                'streetadress2'  => $request['streetadress2'],
                'postcode'  => $request['postcode'],
                'phone' =>$request['phone'],
                'total' =>$request['total'],

            ]);
            $products=Cart::where('user_id',Auth::id())->get();
            foreach ($products as $product) {
                order_item::create([
                    'client_id' => $order->id,
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
            //////
            ///
//            $user=Auth::user();
//            $data=[
//                'CustomerName'       => $user->name,
//                'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
//                'InvoiceValue'       => '50'  , //total price to pay
//                'CustomerMobile'     => $client->phone,
//                'CustomerEmail'      => $user->email,
//                'CallBackUrl'        => 'www.google.com',
//                'ErrorUrl'           => 'www.youtube.com',
//                'Language'           => 'en',
//                'DisplayCurrencyIso' => 'KWD',
//            ];


            DB::commit();
//            return $this->fatoorahServices->sendPayment($data);
            return $this->returnSuccess('order added successfully',200);
           }catch (\Exception $exception){
            DB::rollBack();
            return  $this->returnError($exception->getMessage(),500);
            return  $this->returnError('حدث خطأ ما برجاء المحاولة لاحقا',500);

        }

    }


//    public function payOrder(){
//        $user=Auth::user();
////        $user= Auth::guard('api')->user();
//        dd($user);
//        $client=client::whereId(Auth::id());
////            dd($client);
//        $data=[
//            'CustomerName'       => $user->name,
//            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
//            'InvoiceValue'       => '50'  , //total price to pay
//            'CustomerMobile'     => $client->phone,
//            'CustomerEmail'      => $user->email,
//            'CallBackUrl'        => env('success_url'),
//            'ErrorUrl'           => env('error_url'),
//            'Language'           => 'en',
//            'DisplayCurrencyIso' => 'KWD',
//        ];
//
//        return $this->fatoorahServices->sendPayment($data);
//    }
}
