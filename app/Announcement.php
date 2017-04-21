<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'event_id'];

    public function event()
    {
        return $this->belongsTo('App\Event')[0];
    }
}
