<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteComment extends Model
{
	protected $table = 'notes_comments';
	 public function note()
    {
        return $this->belongsTo('App\Note');
    }

	 public function commenter()
    {
        return $this->belongsTo('App\User','user_id');
    }
}	