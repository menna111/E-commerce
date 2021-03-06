<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable=[
       'name','description','image'

    ];
    public function products(){
        return  $this->hasMany(product::class, 'sub_category_id');
    }
}
