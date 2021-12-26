<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkoutController extends Controller
{
    public function index()
    {
        $id=Auth::id();
        $products=Cart::where('user_id',$id)->get();
        return view('checkout',compact('products'));
    }
}
