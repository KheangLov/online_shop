<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'color',
        'price',
        'size',
        'discount',
        'quantity',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
