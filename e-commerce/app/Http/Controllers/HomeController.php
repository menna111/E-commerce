<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//      $wo= product::all();
//      $w= $wo->subcategory()->where('name','women')->get();

        $trending_products=product::where('trending','1')->take(10)->get();
        $sub_category=SubCategory::all();

//        $shifted = $sub_category->shift();
        return view('home',compact('trending_products','sub_category'));
    }
    public function showcategory($id){
        $sub_category=SubCategory::findOrFail($id);
        $products=product::where('sub_category_id',$id)->get();
        return view('users.products.index',compact('products','sub_category'));
    }
    public function showproduct($id){

           $product= product::findOrFail($id);
            return view('users.products.view',compact('product'));
    }
}
