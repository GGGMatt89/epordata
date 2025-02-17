<?php

namespace App\Http\Controllers;

use App\Models\LastUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LastUpdateController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LastUpdate  $lastUpdate
     * @return \Illuminate\Http\Response
     */
    public function show(LastUpdate $lastUpdate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LastUpdate  $lastUpdate
     * @return \Illuminate\Http\Response
     */
    public function edit(LastUpdate $lastUpdate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LastUpdate  $lastUpdate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LastUpdate $lastUpdate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LastUpdate  $lastUpdate
     * @return \Illuminate\Http\Response
     */
    public function destroy(LastUpdate $lastUpdate)
    {
        //
    }
}
