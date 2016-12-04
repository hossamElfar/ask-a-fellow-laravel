<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PostAnswerApiController extends Controller
{
    public functon index{
    	return questions::all
    }


  	 public function post_answer(Request $request,$question_id)
    {
        $this->validate($request, [
            'answer' => 'required|min:5',
        ]);
        $answer = new Answer;
        $answer->answer = $request->answer;
        $answer->responder_id = Auth::user()->id;
        $answer->question_id = $question_id;
        $answer->save();

        $asker_id = Question::find($question_id)->asker_id;
        $description = Auth::user()->first_name.' '.Auth::user()->last_name.' posted an answer to your question.';
        $link = url('/answers/'.$question_id);
        Notification::send_notification($asker_id,$description,$link);
        return redirect(url('/answers/'.$question_id));
    }


    // public function delete_answer($answer_id)
    // {
    //     $answer = Answer::find($answer_id)->find($answer_id);
    //     if(Auth::user() && (Auth::user()->role > 0 || Auth::user()->id == $answer->responder_id))
    //         $answer->delete();
    //     return redirect(url('answers/'.$answer->question_id));
    // }
}
