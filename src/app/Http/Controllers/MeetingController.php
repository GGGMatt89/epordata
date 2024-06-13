<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
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
    public function index(Request $request)
    {
        $pers_meetings = collect();
        $meetings = Meeting::all();
        $customers = collect();
        foreach ($meetings as $meeting) {
            if (!$customers->contains($meeting->customer)) {
                if ($meeting->customer) {
                    $customers->push($meeting->customer);
                }
            }
        }
        $old_cust = null;
        $old_future = false;
        $old_personal = false;

        if (request('personal') == true || request('personal') == 'on') {
            $pers_meetings = Auth::user()->meetings->sortBy('scheduled_at');
            $meetings = collect();
            $old_personal = true;
        } else {
            $pers_meetings = Auth::user()->meetings->sortBy('scheduled_at');
            $meetings = Meeting::where('user_id', '<>', Auth::user()->id)->get()->sortBy('scheduled_at');
        }

        if (request('customer') && request('customer') != 'unselected') {
            $pers_meetings = $pers_meetings->where('customer_id', $request->customer)->sortBy('scheduled_at');
            $meetings = $meetings->where('customer_id', $request->customer)->sortBy('scheduled_at');
            $old_cust = $request->customer;
        }

        $future_meetings = [];
        $future_pers_meetings = [];

        if (request('future') == true || request('future') == 'on') {
            foreach ($meetings as $meeting) {
                $date = Carbon::parse($meeting->scheduled_at);
                if ($date->gte(Carbon::now())) {
                    array_push($future_meetings, $meeting);
                }
            }
            $meetings = collect($future_meetings);
            foreach ($pers_meetings as $meeting) {
                $date = Carbon::parse($meeting->scheduled_at);
                if ($date->gte(Carbon::now())) {
                    array_push($future_pers_meetings, $meeting);
                }
            }
            $pers_meetings = collect($future_pers_meetings);
            $old_future = true;
        }

        return view('db_views.meeting.index', [
            'meetings' => $meetings,
            'personal_meetings' => $pers_meetings,
            'customers' => $customers
        ])->with(['old_cust' => $old_cust, 'old_future' => $old_future, 'old_personal' => $old_personal]);
    }

    public function show(Meeting $meeting)
    {
        return view('db_views.meeting.show', ['meeting' => $meeting]);
    }

    public function create()
    {
        $customers = Customer::where('profile_id', '<>', Auth::user()->profile->id)->get()->sortBy('last_name');
        return view('db_views.meeting.create', ['personal_customers' => Auth::user()->profile->customers->sortBy('last_name'), 'customers' => $customers, 'users' => User::all()]);
    }

    public function store()
    {
        $validatedAttributes = $this->validateMeeting();
        $timestamp = request('meet_date') . ' ' . request('meet_time');
        $validatedAttributes['scheduled_at'] = $timestamp;
        Meeting::create($validatedAttributes);

        return redirect()->route('meeting.index')->with('success_create', 'Salvato!')->with('alert_text', 'Nuovo appuntamento inserito!');
    }

    public function edit(Meeting $meeting)
    {
        $customers = Customer::where('profile_id', '<>', Auth::user()->profile->id)->get()->sortBy('last_name');
        return view('db_views.meeting.edit', ['meeting' => $meeting, 'personal_customers' => Auth::user()->profile->customers->sortBy('last_name'), 'customers' => $customers, 'users' => User::all()]);
    }

    public function update(Request $request, Meeting $meeting)
    {
        $validatedAttributes = $this->validateMeeting();
        $timestamp = request('meet_date') . ' ' . request('meet_time');
        $validatedAttributes['scheduled_at'] = $timestamp;
        $meeting->update($validatedAttributes);

        return redirect()->route('meeting.show', ['meeting' => $meeting])->with('success_update', 'Salvato!')->with('alert_text', 'Appuntamento del ' . request('meet_date') . ' con ' . $meeting->cust_surname . ' modificato!');
        ;
    }

    public function destroy(Meeting $meeting)
    {
        $date = Carbon::parse($meeting->scheduled_at)->format('d-m-Y');
        $name = $meeting->cust_surname;
        $meeting->delete();
        return redirect()->route('meeting.index')->with('success_delete', 'Eliminato!')->with('alert_text', 'Appuntamento del ' . $date . ' con ' . $name . ' rimosso!');
    }

    protected function validateMeeting()
    {
        $validatedFields = request()->validate([
            'cust_name' => 'required|max:100',
            'cust_surname' => 'required|max:100',
            'customer_id' => 'nullable',
            'meet_address' => 'required',
            'notes' => 'nullable',
            'user_id' => 'required',
            'meet_date' => 'required|date',
            'meet_time' => 'required|date_format:H:i'
        ]);
        if (request('remote') == 'on') {
            $validatedFields['remote'] = true;
        } else {
            $validatedFields['remote'] = false;
        }

        return $validatedFields;
    }
}
