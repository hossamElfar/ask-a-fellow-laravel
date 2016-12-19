<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CourseAPIController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', ['only' => [
        ]]);
    }

	/**
     *  returns a json object of the questions of a certain $course_id order by $order.
     *  $order : votes, latest, oldest, answers
     **/

    public function view_questions($course_id, $order)
    {
    	$course = Course::find($course_id);

    	if(!$course){
            return response()->json([
                'error' => [
                    'message' => 'Course requested not found'
                ]

            ], 404);
        }
    	$questions = $course->questions();
        $order = 'latest';
        $allowed = ['votes','oldest','latest','answers'];
        if(!in_array($order,$allowed))
            $order = 'latest';



        $questions_ordered = array();
        if($order == 'votes')
            $questions_ordered = $questions->orderBy('votes','desc')->orderBy('created_at','desc')->get();
        elseif($order == 'oldest')
            $questions_ordered = $questions->orderBy('created_at','asc')->get();
        elseif($order == 'latest')
            $questions_ordered = $questions->orderBy('created_at','desc')->get();
        else if($order == 'answers')
            $questions_ordered =$questions->orderByRaw("(SELECT COUNT(*) FROM answers WHERE question_id = questions.id) DESC")->orderBy('created_at','desc')->get();


        return response()->json($questions_ordered);

    }
}
