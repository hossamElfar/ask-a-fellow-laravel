<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Component;

class ComponentAPIController extends Controller
{

	public function view_components()
    {

    	$Components = Component::paginate(10);

        if(!$Components){

        	$returnData['status'] = false;
            $returnData['message'] = 'There are no components';

        } else{

        	$returnData['status'] = true;

            foreach ($Components as $Component) {

            	$Component['category'] = $Component->category()->name;
            	$Component['creator_first_name'] = $Component->creator()->first_name;
            	$Component['creator_last_name'] = $Component->creator()->last_name;
               
            }

            $Components->setPath('api/v1/');
            $returnData['data'] = $Components;

        }

        return response()->json($returnData);

    }

}