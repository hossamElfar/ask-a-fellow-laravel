<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\NoteComment;
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

    // post comment 
    public function post_note_comment(Request $request, $note_id)
    {
        $user = Auth::user();
        if (!$user) {
            return ['state' => 'error', 'error' => true];
        }
        $comment = new NoteComment();
        $comment->body = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->note_id = $note_id;
        $comment->save();
    }

    // vote note
    public function vote_note($note_id, $type)
    {
        $user = Auth::user();
        if (!$user) {
            return ['state' => 'error', 'error' => true];
        }

        if ($type == 0 && count($user->upvotesOnNote($note_id)))
            return ['state' => 'cannot up vote twice', 'error' => true];
        if ($type == 1 && count($user->downvotesOnNote($note_id)))
            return ['state' => 'cannot down vote twice', 'error' => true];
        if ($type == 0 && count($user->downvotesOnNote($note_id))) {
            $vote = NoteVote::where('user_id', '=', Auth::user()->id)->where('note_id', '=', $note_id)->first();
            $vote->delete();
        } else if ($type == 1 && count($user->upvotesOnNote($note_id))) {
            $vote = QuestionVote::where('user_id', '=', Auth::user()->id)->where('note_id', '=', $note_id)->first();
            $vote->delete();
        } else
            $user->vote_on_note($note_id, $type);

        // $votes = Note::find($note_id)->votes;
        // $color = 'black';
        // if ($votes > 0)
        //     $color = 'green';
        // elseif ($votes < 0)
        //     $color = 'red';
        // return ['state' => '200 ok', 'error' => false];
    }

}
