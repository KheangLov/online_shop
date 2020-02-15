<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'price',
        'discount',
        'description',
        'condition',
        'status',
        'location',
        'thumbnail',
        'user_id',
        'sub_category_id',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function productVariants()
    {
        return $this->hasMany('App\ProductVariant');
    }
}
