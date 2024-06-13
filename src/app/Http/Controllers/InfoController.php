<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Info;
use ImageResize;

class InfoController extends Controller
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
        return view('db_views.info.index', [
            'infos'=>Info::all()
        ]);
    }

    public function show(Info $info)
    {
        return view('db_views.info.show', ['info' => $info]);
    }

    public function create()
    {
        return view('db_views.info.create');
    }

    public function store(Request $request)
    {
        $validatedAttributes = $this->validateInfo();
        if($request->hasFile('image_path')){
            $imageuploaded = request()->file('image_path');
            $imagename = $this->uploadImage($imageuploaded);
            $validatedAttributes['image_path'] = '/img/infos/' . $imagename;
        }
        Info::create($validatedAttributes);
        return redirect()->route('info.index')->with('success_create', 'Salvata!')->with('alert_text', 'Nuova scheda info inserita!');;
    }

    public function edit(Info $info)
    {
        return view('db_views.info.edit', ['info' => $info]);
    }

    public function update(Request $request, Info $info)
    {
        if($request->hasFile('image_path')) {
            $validatedAttributes = $this->validateInfo();
            $imageuploaded = request()->file('image_path');
            $imagename = $this->uploadImage($imageuploaded);
            $validatedAttributes['image_path'] = '/img/infos/' . $imagename;
        }
        else{
            $validatedAttributes = $this->validateInfoNoImg();
        }
        $info->update($validatedAttributes);
        return redirect()->route('info.show', ['info' => $info])->with('success_update', 'Salvata!')->with('alert_text', 'Scheda info modificata!'); ;
    }

    public function destroy(Info $info)
    {
        $same_image = Info::where('image_path', $info->image_path)->where('id', '<>', $info->id);
        if($same_image->count() == 0 && $info->image_path <> '/img/info/default.png'){
            File::delete(public_path().$info->image_path);
        }
        $info->delete();
        return redirect()->route('info.index')->with('success_delete', 'Eliminata!')->with('alert_text', 'Scheda info rimossa!');;
    }


    protected function validateInfo()
    {
        return request()->validate([
            'title'=>'required',
            'excerpt'=>'required',
            'body'=>'required',
            'preview_title'=>'required',
            'preview_subtitle'=>'nullable',
            'image_path' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
    }

    protected function validateInfoNoImg()
    {
        return request()->validate([
            'title'=>'required',
            'excerpt'=>'required',
            'body'=>'required',
            'preview_title'=>'required',
            'preview_subtitle'=>'nullable',
        ]);
    }

    protected function uploadImage($imageuploaded)
    {
        $imagename = time() . '_info.' . $imageuploaded->extension();
        $storepath = config('app.local_public_path').'img/infos';
        $imageresized = ImageResize::make($imageuploaded->path());
        $imageresized->resize(250, 170)->save($storepath.'/'.$imagename);
        return $imagename;
    }
}
