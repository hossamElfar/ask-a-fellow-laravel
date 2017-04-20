<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Auth;
use Log;

use App\Http\Requests;

class NotesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function request_delete(Request $request, $note_id)
  {

    $this->validate($request, [
      'comment' => 'required',
    ]);

    $note = Note::find($note_id);
    //$user = User::find(1);

    if(Auth::user() &&  Auth::user()->id == $note->user_id){
      if($note->request_delete == true)
      return 'you already requested to delete this note';

      $note->request_delete = true;
      $note->comment_on_delete = $request -> $delete_comment;
      $note->save();

      // Log::info('saved');
      // Log::info($note);
      // return response($note);

      Session::flash('updated', 'Your request to delete this note is now handled');
      redirect(url('/note/'.$note->id));
    }
    else
    return 'Not allowed to delete this note';

  }
}
