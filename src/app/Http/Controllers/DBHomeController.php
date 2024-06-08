<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Meeting;

class DBHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //DEFAULT#return view('home');
        $meetings = null;
        $users = [];
        $full_meetings = [];
        if (Auth::user()->auth_level == 'Admin' || Auth::user()->auth_level == 'Operator') {
            $meetings = Meeting::all();
            foreach ($meetings as $meeting) {
                array_push($users, $meeting->user);
            }
        } else {
            $meetings = Auth::user()->meetings;
        }
        foreach ($meetings as $meeting) {
            $meeting->user_name = $meeting->user->profile->first_name;
            $meeting->user_lastname = $meeting->user->profile->last_name;
            array_push($full_meetings, $meeting);
        }
        return view('/db_views/db_home', [
            'meetings' => $full_meetings, 'users' => array_unique($users)
        ]);
    }
}
