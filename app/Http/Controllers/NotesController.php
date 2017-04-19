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

      public function upload_notes_form(Request $request,$courseID)
    {
        $user = Auth::user();
        if (!$user)
            return 'Ooops! Not authorized';
        return view('notes.uploadNotes');
    }

    public function upload_notes(Request $request, $courseID)
    {
        $this->validate($request, [
            'title' => 'alpha|required',
            'path' => 'alpha|required',
            'description' => 'alpha|required',
        ]);
        $user = Auth::user();
        $note = new Note;
        $note->user_id = Auth::user()->id;
        $note->course_id = $courseID;
        $note->title = $request->title;
        $note->path = $request->path;
        $note->description = $request->description;
        $note->request_upload = true;

        $question->save();
        return redirect('/');
    }

}
