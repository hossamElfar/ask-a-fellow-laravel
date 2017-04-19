<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentAnswer extends Model
{
    protected $fillable = [
        'answer'
    ];

    public function responder()
    {
        return $this->belongsTo('App\User')->first();
    }

    public function question()
    {
        return $this->belongsTo('App\ComponentQuestion');
    }
}
