<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable=[
        'client_id','product_id','product_name','qty','price'
    ];

    function client(){
        return $this->belongsTo(client::class);
    }
    function product(){
        return $this->belongsTo(product::class);
    }
}
