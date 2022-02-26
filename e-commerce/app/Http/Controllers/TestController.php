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
                'sub_category_id'=> 1,
                'name' => 'product number ' . $i,
                'description' => 'description',
                'original_price' =>1000,
                'after_sale'=>900,
                'image'     => 'uploaded/categories/KsBrLPYVHn6hoXmgJTPE.png',
                'qty' => 10,
                'tax' => 10,
                'trending' =>  1 ,

            ]);
        }
        dd('done');
    }
}
