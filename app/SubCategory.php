<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SubCategory extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'description', 'user_id', 'category_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
