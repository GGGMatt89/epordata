<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Profile;

class ProfileController extends Controller
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
        return view('db_views.profile.index', [
            'profiles' => Profile::all()->sortBy('last_name')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('db_views.profile.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes = $this->validateProfile();
        if($request->hasFile('image')){
            $imageuploaded = request()->file('image');
            $imagename = $this->uploadImage($imageuploaded);
            $validatedAttributes['image']='/img/users/' . $imagename;
        }
        Profile::create($validatedAttributes);

        return redirect()->route('db_home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('db_views.profile.show', ['profile' => $profile]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('db_views.profile.edit', ['profile' => $profile]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        if($request->hasFile('image')) {
            $validatedAttributes = $this->validateProfile();
            $imageuploaded = request()->file('image');
            $imagename = $this->uploadImage($imageuploaded);
            $validatedAttributes['image'] = '/img/users/' . $imagename;
        }
        else{
            $validatedAttributes = $this->validateProfileNoImg();
        }
        $profile->update($validatedAttributes);
        return redirect()->route('profile.show', ['profile'=>$profile])->with('success_create', 'Salvato!')->with('alert_text', 'Profilo modificato per '.$profile->first_name.' '.$profile->last_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profile.index');
    }

    protected function validateProfile()
    {
        return request()->validate([
            'first_name'=>'required|max:100',
            'last_name'=>'required|max:100',
            'birth_date'=>'nullable|date',
            'tax_code'=>'nullable|alpha_num|max:16',
            'res_address'=>'nullable',
            'res_city'=>'nullable',
            'post_code'=>'nullable|digits_between:0,5',
            'mobile_phone'=>'nullable|digits_between:10,13',
            'area'=>'nullable',
            'user_id'=>'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
    }
    protected function validateProfileNoImg()
    {
        return request()->validate([
            'first_name'=>'required|max:100',
            'last_name'=>'required|max:100',
            'birth_date'=>'nullable|date',
            'tax_code'=>'nullable|alpha_num|max:16',
            'res_address'=>'nullable',
            'res_city'=>'nullable',
            'post_code'=>'nullable|digits_between:0,5',
            'mobile_phone'=>'nullable|digits_between:10,13',
            'area'=>'nullable',
            'user_id'=>'required',
        ]);
    }
    protected function uploadImage($imageuploaded)
    {
        $imagename = request('first_name') . '_' . request('last_name') . '.' . $imageuploaded->extension();
        $storepath = config('app.local_public_path').'img/users';
        $imageresized = ImageResize::make($imageuploaded->path());
        $imageresized->resize(150, 150, function ($constraint) {
            // $constraint->aspectRatio();
            $constraint->upsize();
        })->save($storepath.'/'.$imagename);
        return $imagename;
    }
}
