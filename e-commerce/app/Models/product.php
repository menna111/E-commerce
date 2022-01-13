<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\SubCategory;
class product extends Model
{
    use HasFactory;
    protected $fillable=[
        'cate_id',
        'sub_category_id',
        'name',
        'description',
        'original_price',
        'after_sale',
        'image',
        'qty',
        'tax',
        'trending',


    ];
    public function category(){
    return $this->belongsTo(Category::class,'cate_id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }


}
