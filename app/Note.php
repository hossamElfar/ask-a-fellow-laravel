<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
