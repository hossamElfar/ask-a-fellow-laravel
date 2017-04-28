<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StaticController extends Controller
{
    public function about() {

        return view('statics.about');
    }


    public function howitworks() {
        return view('statics.howitworks');
    }
}
