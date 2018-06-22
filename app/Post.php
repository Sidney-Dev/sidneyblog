<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Post extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'photo', 'category_id'];

    use Sluggable;
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
