<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductVariant extends Model
{
    use LogsActivity;

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
