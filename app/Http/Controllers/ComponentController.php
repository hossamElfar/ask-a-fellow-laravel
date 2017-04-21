<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ComponentController extends Controller
{
	/*
	* Gets all the info of the requested question from the data base and returns it to the view
	*/
    public function fetch_info($id)
    {
    	// search for this id
    	$question = App\QuestionComponent::find($id);

    	// The question id was not found 
    	if(is_null($question))
    	{
    		app::abort(404);
    	}

    	// search for the user who asked the question
    	$user_id = $question['user_id'];

    	$user = App\User::find($user_id);

    	// if the user doesnot exist, then something must be wrong with the database
    	if(is_null($user))
    	{
    		app::abort(500);
    	}


    	// fetches all the responses
    	$username = $user['first_name'] . " " . $user['last_name']; 

    	$response = App\ResponseComponent::where('question_id', $id)->get();

    	// arranges all the info in an array
    	$info = ['time' => $question['created_at'], 'question_id' => $id, 'category' => $question['category'], 'component' => $question['component'], 'location' => $question['location'], 'user_id' => $user_id, 'username' => $username, "picture" => $user['profile_picture'], 'responses' => $response];
    	return view('components.question', $info);



    }
}
