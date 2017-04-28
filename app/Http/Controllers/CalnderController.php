<?php

namespace App\Http\Controllers;

use App\Calender;
use App\Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CalnderController extends Controller
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
        if ($user->calenders()->count() != 0) {
            return "u already have a calender ";
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
    public function removeEvent($event_id)
    {
        
        $user = Auth::user();
        $calender = $user->calender()->get();
        $event = Event::findOrFail($event_id);
        $calender->events()->detach($event);
        return "Successfully Removed From Your Calendar";
    }

}
