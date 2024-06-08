<?php

namespace App\Http\Controllers;

use App\Participant;
use App\Lecture;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    var $roles = array('Professionista', 'Dipendente', 'Finanziato', 'Uditore');

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('customer_id')){
            $participants = Participant::where('customer_id', request('customer_id'))->get();
            $customer_id = request('customer_id');
            $lecture_id = null;
            $customer = Customer::where('id', request('customer_id'))->firstOrFail();
            $page_title = ucfirst($customer->title).' '.$customer->last_name.' partecipa a';
            $table_title = "Corso";     
        }
        else if(request('lecture_id')){
            $participants = Participant::where('lecture_id', request('lecture_id'))->get();
            $lecture_id = request('lecture_id');
            $customer_id = null;
            $lecture = Lecture::where('id', request('lecture_id'))->firstOrFail();
            $page_title = 'Partecipanti a '.$lecture->title;
            $table_title = "Cliente";
        }
        else{
            $participants = Participant::all();
            $customer_id = null;
            $lecture_id = null;
            $page_title = 'Tutti i partecipanti a corsi';
            $table_title = "Partecipante - Corso";
        }

        return view('db_views.participant.index', ['page_title'=>$page_title, 'participants'=>$participants, 'customer_id'=>$customer_id, 'lecture_id'=>$lecture_id, 'table_title'=>$table_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request('customer_id')){
            $lectures = Lecture::all();
            $customers = Customer::where('id', request('customer_id'))->firstOrFail();
            $page_title = 'Iscrizione di '.$customers->title.' '.$customers->last_name.' ad un corso / seminario';
            $assoc = 'customer';     
        }
        else if(request('lecture_id')){
            $lectures = Lecture::where('id', request('lecture_id'))->firstOrFail();
            $customers = Customer::all();
            $page_title = 'Aggiungi partecipante a '.$lectures->title;
            $assoc = 'lecture';
        }
        else{
            $customers = Customer::all();
            $lectures = Lecture::all();
            $page_title = 'Iscrivi cliente ad un corso / seminario';
            $assoc = null;
        }
        return view('db_views.participant.create', ['page_title'=>$page_title, 'assoc'=> $assoc, 'customers' => $customers, 'lectures'=>$lectures, 'roles'=>$this->roles]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateParticipant();
        $lecture = Lecture::where('id', $validated['lecture_id'])->firstOrFail();
        Participant::create($validated);
        return redirect()->route('participant.index', ['lecture_id'=>$validated['lecture_id']])->with('success_create', 'Iscritto!')->with('alert_text', $validated['last_name'].' parteciperà a '.$lecture->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        return view('db_views.participant.show', ['participant' => $participant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        return view('db_views.participant.edit', ['participant' => $participant, 'roles'=>$this->roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        $participant->update($this->validateParticipant());
        return redirect()->route('participant.index', ['lecture_id'=>$participant->lecture_id])->with('success_create', 'Salvato!')->with('alert_text', 'Scheda partecipante modificata!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        $name=$participant->last_name;
        $lecture=Lecture::where('id', $participant->lecture_id)->firstOrFail();
        $participant->delete();
        return redirect()->route('participant.index', ['lecture_id'=>$lecture->id])->with('success_create', 'Eliminato!')->with('alert_text', $name.' disiscritto da '.$lecture->title);
    }

    protected function validateParticipant()
    {
        $validatedFields =  request()->validate([
            'customer_id'=>'nullable',
            'lecture_id'=>'required',
            'role'=>['required', 'string', Rule::in($this->roles)],
            'first_name'=>'required|max:100',
            'last_name'=>'required|max:100'
        ]);
        if(request('payed') == 'on'){
            $validatedFields['payed'] = true;  
        }
        else{
            $validatedFields['payed'] = false;
        }
        return $validatedFields;  
    }
}
