<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
  public function note()
    {
        return $this->belongsTo('App\Note');
    }

    public function upvotes()
    {
        return $this->hasMany('App\NoteVote')->where('type','=',0)->get();
    }

    public function downvotes()
    {
        return $this->hasMany('App\NoteVote')->where('type','=',1)->get();
    }
}
