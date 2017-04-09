<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class StoreController extends Controller
{
    public function show($location)
    {
    	$stores = DB::table('stores')->where('location', $location)->get();
        return view('store.store_by_location')->with('stores', $stores);
    }
}
