<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'date', 'place'
    ];

    public function calenders()
    {
        return $this->hasMany('App\Calender');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function announcements()
    {
        return $this->hasMany('App\Announcement');
    }
}
