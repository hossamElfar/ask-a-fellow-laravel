<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PostAnswerApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => []]);
    }

  	 public function post_answer(Request $request)
    {

        $returnData = array();

      
        
        $question = Question::find($question_id);
        $answer = Answer::find($answer_id);
        //checks if request came from a user
        if (!$question or !$answer or !($request->is('user/*'))){
            $returnData['status'] = false;
            $returnData['message'] = 'User not registered!';
        }else{
        /*
        retrieving information required to add a row in database for request object from application
        */
        $answer = $request->only(['answer']);
        $question_id = $request->only(['question_id']);
        $responser_id = $request->only(['responser_id']);

        DB::table('answers')->insert([
                'answer' => $answer,
                'question_id' => $question_id,
                'responser_id' => $responser_id
                ]);
        }
        $request->flash(); //refreshes inputs to be available on user's next request
        }
        array_push($returnData, $answer);
        array_push($returnData, $question_id);
        array_push($returnData, $responser_id);

        return response()->json($returnData);
    }
}
