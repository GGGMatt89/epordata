<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\News;
use ImageResize;

class NewsController extends Controller
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
        return view('db_views.news.index', [
            'news_all' => News::all()
        ]);
    }

    public function show(News $news)
    {
        return view('db_views.news.show', ['news' => $news]);
    }

    public function create()
    {
        return view('db_views.news.create');
    }

    public function store(Request $request)
    {
        $validatedAttributes = $this->validateNews();
        if ($request->hasFile('image_path')) {
            $imageuploaded = request()->file('image_path');
            $imagename = $this->uploadImage($imageuploaded);
            $validatedAttributes['image_path'] = '/img/news/' . $imagename;
        }
        News::create($validatedAttributes);
        return redirect()->route('news.index')->with('success_create', 'Salvata!')->with('alert_text', 'Nuova scheda news inserita!');
    }

    public function edit(News $news)
    {
        return view('db_views.news.edit', ['news' => $news]);
    }

    public function update(Request $request, News $news)
    {
        if ($request->hasFile('image_path')) {
            $validatedAttributes = $this->validateNews();
            $imageuploaded = request()->file('image_path');
            $imagename = $this->uploadImage($imageuploaded);
            $validatedAttributes['image_path'] = '/img/news/' . $imagename;
        } else {
            $validatedAttributes = $this->validateNewsNoImg();
        }
        $news->update($validatedAttributes);

        return redirect()->route('news.show', ['news' => $news])->with('success_update', 'Salvata!')->with('alert_text', 'Scheda news modificata!');
        ;
    }

    public function destroy(News $news)
    {
        $same_image = News::where('image_path', $news->image_path)->where('id', '<>', $news->id);
        if ($same_image->count() == 0 && $news->image_path <> '/img/news/default.png') {
            File::delete(public_path() . $news->image_path);
        }
        $news->delete();
        return redirect()->route('news.index')->with('success_delete', 'Eliminata!')->with('alert_text', 'Scheda news rimossa!');
    }

    protected function validateNews()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'preview_title' => 'required',
            'preview_subtitle' => 'nullable',
            'date' => 'required|date|after_or_equal:today',
            'image_path' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
    }

    protected function validateNewsNoImg()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'preview_title' => 'required',
            'preview_subtitle' => 'required',
            'date' => 'required|date|after_or_equal:today'
        ]);
    }

    protected function uploadImage($imageuploaded)
    {
        $imagename = time() . '_news.' . $imageuploaded->extension();
        $storepath = config('app.local_public_path') . 'img/news';
        $imageresized = ImageResize::make($imageuploaded->path());
        $imageresized->resize(250, 170)->save($storepath . '/' . $imagename);
        // , function ($constraint) {
        //     // $constraint->aspectRatio();
        //     $constraint->upsize();
        // })->save($storepath.'/'.$imagename);
        return $imagename;
    }
}
