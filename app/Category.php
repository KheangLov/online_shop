<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subCategories()
    {
        return $this->hasMany('App\SubCategory');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
