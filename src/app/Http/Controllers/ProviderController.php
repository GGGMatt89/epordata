<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProviderController extends Controller
{
    public $categories = ['Generalista', 'Partner', 'Sponsor', 'Docente'];

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
        $providers = (new Provider)->newQuery();//::all()->sortBy('name');
        $regions = DB::table('providers')->orderBy('region')->distinct()->pluck('region');
        $regions = $regions->filter(function ($value) { return !is_null($value); });
        $old_cat = null;
        $old_region = null;
        if ($request->has('category')) {
            if ($request->category != 'unselected') {
                $old_cat = $request->category;
                $providers->where('category', $request->category);
            }
        }
        if ($request->has('region')) {
            if ($request->region != 'unselected') {
                $old_region = $request->region;
                $providers->where('region', $request->region);
            }
        }
        $sel_providers = $providers->get()->sortBy('bus_name');

        return view('db_views.provider.index', [
            'providers' => $sel_providers, 'regions' => $regions, 'categories' => $this->categories
        ])->with(['old_cat' => $old_cat, 'old_region' => $old_region]);
        // return view('db_views.provider.index', [
        //     'providers' => Provider::all()->sortBy('bus_name')
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('db_views.provider.create', ['categories' => $this->categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Provider::create($this->validateProvider());
        return redirect()->route('provider.index')->with('success_create', 'Salvato!')->with('alert_text', 'Nuovo fornitore inserito!');
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return view('db_views.provider.show', ['provider' => $provider]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        return view('db_views.provider.edit', ['provider' => $provider, 'categories' => $this->categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $provider->update($this->validateProvider($provider));
        return redirect()->route('provider.index')->with('success_create', 'Salvato!')->with('alert_text', 'Scheda fornitore modificata!');
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('provider.index')->with('success_create', 'Eliminato!')->with('alert_text', 'Fornitore rimosso!');
        ;
    }

    public function getProvider(Provider $provider)
    {
        return $provider;
    }

    protected function validateProvider(Provider $provider = null)
    {
        $validatedFields = request()->validate([
            'bus_name' => 'required|max:100',
            'code' => 'required|max:100',
            'tax_code' => 'required|alpha_num|max:16',
            'vat_num' => 'required|alpha_num|max:11',
            'univ_code' => 'nullable|alpha_num|max:10',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('providers')->ignore($provider)],
            'pec' => ['nullable', 'string', 'email', 'max:255', Rule::unique('providers')->ignore($provider)],
            'office_phone' => 'nullable',
            'mobile_phone' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'post_code' => 'nullable',
            'region' => 'nullable',
            'category' => ['nullable', Rule::in(['Generalista', 'Partner', 'Sponsor', 'Docente'])],
            'ref_name' => 'nullable',
            'ref_surname' => 'nullable',
            'ref_title' => 'nullable',
            'ref_phone' => 'nullable',
            'ref_email' => 'nullable|email'
        ]);
        if (request('category') == '') {
            $validatedFields['category'] = null;
        }
        return $validatedFields;
    }
}
