<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Customer;
use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public $ratings = ['Prospect', 'Standard', 'Vip'];
    public $categories = ['Fiscale', 'Legale', 'Notaio', 'Lavoro', 'Tecnico', 'Azienda/Ente', 'Altro'];
    public $handlers = ['Fiscale', 'Legale', 'Altro'];

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
    public function index(Request $request)
    {
        $customers = (new Customer)->newQuery();//::all()->sortBy('name');
        $regions = DB::table('customers')->orderBy('region')->distinct()->pluck('region');
        $regions = $regions->filter(function ($value) { return !is_null($value); });
        $old_cat = null;
        $old_rating = null;
        $old_handler = null;
        $old_region = null;
        $old_personal = false;
        if ($request->has('category')) {
            if ($request->category != 'unselected') {
                $old_cat = $request->category;
                $customers->where('category', $request->category);
            }
        }
        if ($request->has('handler')) {
            if ($request->handler != 'unselected') {
                $old_handler = $request->handler;
                $customers->where('handler', $request->handler);
            }
        }
        if ($request->has('rating')) {
            if ($request->rating != 'unselected') {
                $old_rating = $request->rating;
                $customers->where('rating', $request->rating);
            }
        }
        if ($request->has('region')) {
            if ($request->region != 'unselected') {
                $old_region = $request->region;
                $customers->where('region', $request->region);
            }
        }
        if ($request->has('personal')) {
            if ($request->personal == 'on' || $request->personal == true || $request->personal == 1) {
                $old_personal = true;
                $customers->where('profile_id', Auth::user()->profile->id);
            }
        }
        $sel_customers = $customers->get()->sortBy('last_name');

        return view('db_views.customer.index', [
            'customers' => $sel_customers, 'ratings' => $this->ratings, 'categories' => $this->categories, 'handlers' => $this->handlers, 'regions' => $regions
        ])->with(['old_cat' => $old_cat, 'old_handler' => $old_handler, 'old_rating' => $old_rating, 'old_region' => $old_region, 'old_personal' => $old_personal]);
    }

    public function listMeetings(Customer $customer)
    {
        $meetings = Meeting::where('customer_id', $customer->id)->where('user_id', '<>', Auth::user()->id)->get()->sortBy('scheduled_at');
        $pers_meetings = Auth::user()->meetings->where('customer_id', $customer->id)->sortBy('scheduled_at');
        $customers = Auth::user()->profile->customers;
        return view('db_views.meeting.index', [
            'meetings' => $meetings,
            'personal_meetings' => $pers_meetings,
            'customers' => $customers
        ])->with(['old_cust' => $customer->id, 'old_future' => false, 'old_personal' => false]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profiles = Profile::all();
        return view('db_views.customer.create', ['profiles' => $profiles, 'ratings' => $this->ratings, 'categories' => $this->categories, 'handlers' => $this->handlers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Customer::create($this->validateCustomer());
        return redirect()->route('customer.index')->with('success_create', 'Salvato!')->with('alert_text', 'Nuovo cliente inserito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('db_views.customer.show', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $profiles = Profile::all();
        return view('db_views.customer.edit', ['customer' => $customer, 'profiles' => $profiles, 'ratings' => $this->ratings, 'categories' => $this->categories, 'handlers' => $this->handlers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validatedUpdate = $this->validateUpdateCustomer($customer);
        $customer->update($validatedUpdate);
        return redirect()->route('customer.show', ['customer' => $customer])->with('success_update', 'Salvato!')->with('alert_text', $customer->last_name . ' ' . $customer->first_name . ' modificato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $last_name = $customer->last_name;
        $first_name = $customer->first_name;
        $customer->delete();
        return redirect()->route('customer.index')->with('success_delete', 'Eliminato!')->with('alert_text', $last_name . ' ' . $first_name . ' rimosso!');
    }

    public function getCustomer(Customer $customer)
    {
        return $customer;
    }

    protected function validateCustomer()
    {
        $validatedFields = request()->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'title' => 'required|max:100',
            'bus_name' => 'required|max:100',
            'cus_code' => 'required|max:100',
            'tax_code' => 'required|alpha_num|max:16',
            'vat_num' => 'required|alpha_num|max:11',
            'univ_code' => 'nullable|alpha_num|max:10',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('customers')],
            'pec' => ['nullable', 'string', 'email', 'max:255', Rule::unique('customers')],
            'office_phone' => 'nullable',
            'mobile_phone' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'post_code' => 'nullable',
            'region' => 'nullable',
            'rating' => ['nullable', Rule::in(['', 'Vip', 'Prospect', 'Standard'])],
            'category' => ['nullable', Rule::in(['', 'Fiscale', 'Legale', 'Notaio', 'Lavoro', 'Tecnico', 'Azienda/Ente', 'Altro'])],
            'handler' => ['nullable', Rule::in(['', 'Fiscale', 'Legale', 'Altro'])],
            'ref_name' => 'nullable',
            'ref_surname' => 'nullable',
            'ref_title' => 'nullable',
            'ref_phone' => 'nullable',
            'ref_email' => 'nullable|email',
            'profile_id' => 'nullable'
        ]);
        if (request('rating') == '') {
            $validatedFields['rating'] = null;
        }
        if (request('category') == '') {
            $validatedFields['category'] = null;
        }
        if (request('handler') == '') {
            $validatedFields['handler'] = null;
        }
        if (request('profile_id') == '') {
            $validatedFields['profile_id'] = null;
        }
        return $validatedFields;
    }

    protected function validateUpdateCustomer(Customer $customer)
    {
        $validatedFields = request()->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'title' => 'required|max:100',
            'bus_name' => 'required|max:100',
            'cus_code' => 'required|max:100',
            'tax_code' => 'required|alpha_num|max:16',
            'vat_num' => 'required|alpha_num|max:11',
            'univ_code' => 'nullable|alpha_num|max:10',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('customers')->ignore($customer)],
            'pec' => ['nullable', 'string', 'email', 'max:255', Rule::unique('customers')->ignore($customer)],
            'office_phone' => 'nullable',
            'mobile_phone' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'post_code' => 'nullable',
            'region' => 'nullable',
            'rating' => ['nullable', Rule::in(['', 'Vip', 'Prospect', 'Standard'])],
            'category' => ['nullable', Rule::in(['', 'Fiscale', 'Legale', 'Notaio', 'Lavoro', 'Tecnico', 'Azienda/Ente', 'Altro'])],
            'handler' => ['nullable', Rule::in(['', 'Fiscale', 'Legale', 'Altro'])],
            'ref_name' => 'nullable',
            'ref_surname' => 'nullable',
            'ref_title' => 'nullable',
            'ref_phone' => 'nullable',
            'ref_email' => 'nullable|email',
            'profile_id' => 'nullable'
        ]);
        if (request('rating') == '') {
            $validatedFields['rating'] = null;
        }
        if (request('category') == '') {
            $validatedFields['category'] = null;
        }
        if (request('handler') == '') {
            $validatedFields['handler'] = null;
        }
        if (request('profile_id') == '') {
            $validatedFields['profile_id'] = null;
        }
        return $validatedFields;
    }
}
