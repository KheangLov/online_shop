<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

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
