<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
<<<<<<< HEAD
    //
=======
    protected $fillable = [
        'title', 'description', 'contact_info', 'price',
        'image_path', 'accepted'
    ];

    public function creator()
    {
        return $this->belongsTo('App\User')->first();
    }

    public function category()
    {
        return $this->belongsTo('App\ComponentCategory')->first();
    }

    public function questions()
    {
        return $this->hasMany('App\ComponentQuestion');
    }
>>>>>>> e96ac43382cdd4f9077ef71621bd8729a126b873
}
