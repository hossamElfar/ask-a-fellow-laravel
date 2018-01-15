<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Store;


class StoresAPIController extends Controller
{
    // search by id
    public function search_by_id($id){
        $Stores = Store::find($id);
        error_log($Stores);
        return response()->json($Stores);
    }

    // search by name
    public function search_by_name($name){
        $Stores = Store::where('name', $name)->first();
        return response()->json($Stores);
    }

    // search by location
    public function search_by_location($location){
        $Stores = Store::where('location', $location)->first();
        return response()->json($Stores);
    }

    // sort by rating
    public function sort_by_rating($rate){
        $Stores = Store::paginate(10);
        error_log($Stores);

        if(!$Stores){

        	$returnData['status'] = false;
            $returnData['message'] = 'There are no components';

        } else{

        	$returnData['status'] = true;
            $Stores->setPath('api/v1/');
            $returnData['data'] = $Stores;

        }

        return response()->json($returnData);
    }
}
