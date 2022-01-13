<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ResponseTrait;
    public function index(){
       $cart= Cart::select('product_name','product_qty','product_price','total','image')->where('user_id',Auth::id())->first();

       return $this->returnData('all in cart',$cart,200);
    }
}
