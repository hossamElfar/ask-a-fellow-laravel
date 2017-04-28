<?php

namespace App\Http\Controllers;

use App\Calender;
use App\Event;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CalenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware('auth_admin')->only(['show']);
    }

    /**
     * Create a new calender
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        if ($user->calender()->count() != 0) {
            return redirect()->back();
        } else {
            $calender = new Calender();
            $calender->user_id = $user->id;
            $calender->save();
            return "Created successfully";
        }
    }

    /**
     * Get the calender
     *
     * @param $calender_id
     * @return mixed
     */
    public function show($calender_id)
    {
        $calender = Calender::findOrFail($calender_id);
        $evets = $calender->events()->get();
        return $calender;
    }

    /**
     * View the calender of the authenticated user
     *
     * @return mixed
     */
    public function viewCalender()
    {
        $user = Auth::user();
        $calender = $user->calender()->get();
        return $calender;
    }

    /**
     * Add an Event to user's calender
     *
     * @param $event_id
     * @return string
     */
    public function addEvent($event_id)
    {
        $user = Auth::user();
        $calender = $user->calender()->get();
        $event = Event::findOrFail($event_id);
        $calender->events()->attach($event);
        return "Done";
    }

    public function showUserCalender($id)
    {
        $user = User::find($id);
        $calender = $user->calender()->get()->first();
        if($calender == null){
            return view('user.calender',compact('calender','user'));
        }else{
            $events = $calender->events()->orderBy('date')->get();
            return view('user.calender',compact('events','calender','user'));
        }

    }

}
