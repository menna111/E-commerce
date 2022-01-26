<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use App\Models\SubCategory;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ResponseTrait;

    public function categories(){
        $cats=Category::select('name','description','image')->get();
        return $this->returnData('all categories',$cats,200);
    }

    public function subcategories(){
        $subcats=SubCategory::select('name','description','image')->get();
        return $this->returnData('all categories',$subcats,200);
    }

    public function products(){

        $products=product::select('name','description','image','original_price','after_sale')->get();
        return $this->returnData('all categories',$products,200);
    }
}
