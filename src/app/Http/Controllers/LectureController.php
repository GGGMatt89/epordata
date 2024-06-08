<?php

namespace App\Http\Controllers;

use App\Lecture;
use App\Product;
use Illuminate\Http\Request;

class LectureController extends Controller
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
        return view('db_views.lecture.index', [
            'lectures' => Lecture::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('db_views.lecture.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes = $this->validateLecture();
        $timestamp_beg = request('beg_date') . ' ' . request('beg_time');
        $validatedAttributes['beginning'] = $timestamp_beg;
        $timestamp_end = request('end_date') . ' ' . request('end_time');
        $validatedAttributes['end'] = $timestamp_end;
        Lecture::create($validatedAttributes);
        return redirect()->route('lecture.index')->with('success_create', 'Salvato!')->with('alert_text', 'Nuovo corso/seminario inserito!');
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        return view('db_views.lecture.show', ['lecture' => $lecture]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecture $lecture)
    {
        $products = Product::all();
        return view('db_views.lecture.edit', ['lecture' => $lecture, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecture $lecture)
    {
        $validatedAttributes = $this->validateLecture();
        $timestamp_beg = request('beg_date') . ' ' . request('beg_time');
        $validatedAttributes['beginning'] = $timestamp_beg;
        $timestamp_end = request('end_date') . ' ' . request('end_time');
        $validatedAttributes['end'] = $timestamp_end;
        $lecture->update($validatedAttributes);
        return redirect()->route('lecture.show', ['lecture' => $lecture])->with('success_update', 'Salvato!')->with('alert_text', $lecture->title . ' modificato!');
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecture $lecture)
    {
        $title = $lecture->title;
        $lecture->delete();
        return redirect()->route('lecture.index')->with('success_delete', 'Eliminato!')->with('alert_text', $title . ' rimosso!');
        ;
    }

    protected function validateLecture()
    {
        return request()->validate([
            'title' => 'required',
            'place' => 'required',
            'beg_date' => 'required|date|after_or_equal:today',
            'beg_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:beg_date',
            'end_time' => 'required|date_format:H:i',
            'last' => 'nullable',
            'cfp' => 'nullable',
            'price' => 'nullable',
            'cr_body' => 'nullable',
            'provider' => 'nullable',
            'description' => 'nullable'
        ]);
    }
}
