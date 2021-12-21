<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        for ($i = 1; $i < 30 ; $i++) {
            product::create([
                'cate_id'=>1,
                'sub_category_id'=> 2,
                'name' => 'product number ' . $i,

                'small_description' => 'small description',
              'description' => 'description',
               'original_price' =>1000,
                'after_sale'=>900,
                'image'     => 'uploaded/categories/KsBrLPYVHn6hoXmgJTPE.png',
                'qty' => 10,
                'tax' => 10,
                'status' =>  0,
                'trending' =>  1 ,
                'meta_title' => 'desc',
                'meta_keywords' => 'desc',
                'meta_description' => 'desc',
            ]);
        }
        dd('done');
    }
}
