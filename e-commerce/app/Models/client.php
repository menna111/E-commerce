<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id','fname','lname','country','town','streetadress1','streetadress2','postcode','phone'
    ];

    function user(){
        return $this->belongsTo(User::class);
    }
}
