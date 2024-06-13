<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use ImageResize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OfferController extends Controller
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
        $offers = Offer::all();
        return view('db_views.offer.index', [
            'offers' => $offers
        ]);
    }

    public function show(Offer $offer)
    {
        return view('db_views.offer.show', ['offer' => $offer]);
    }

    public function create()
    {
        return view('db_views.offer.create');
    }

    public function store(Request $request)
    {
        $validatedAttributes = $this->validateOffer();
        if ($request->hasFile('image_path')) {
            $imageuploaded = request()->file('image_path');
            $imagename = $this->uploadImage($imageuploaded);
            $validatedAttributes['image_path'] = '/img/offers/' . $imagename;
        }
        Offer::create($validatedAttributes);
        return redirect()->route('offer.index')->with('success_create', 'Salvata!')->with('alert_text', 'Nuova scheda offerta inserita!');
        ;
    }

    public function edit(Offer $offer)
    {
        return view('db_views.offer.edit', ['offer' => $offer]);
    }

    public function update(Request $request, Offer $offer)
    {
        if ($request->hasFile('image_path')) {
            $validatedAttributes = $this->validateOffer();
            $imageuploaded = request()->file('image_path');
            $imagename = $this->uploadImage($imageuploaded);
            $validatedAttributes['image_path'] = '/img/offers/' . $imagename;
        } else {
            $validatedAttributes = $this->validateOfferNoImg();
        }
        $offer->update($validatedAttributes);

        return redirect()->route('offer.show', ['offer' => $offer])->with('success_create', 'Salvata!')->with('alert_text', 'Scheda offerta modificata!');
        ;
    }

    public function destroy(Offer $offer)
    {
        $same_image = Offer::where('image_path', $offer->image_path)->where('id', '<>', $offer->id);
        if ($same_image->count() == 0 && $offer->image_path <> '/img/offers/default.png') {
            File::delete(public_path() . $offer->image_path);
        }
        $offer->delete();
        return redirect()->route('offer.index')->with('success_delete', 'Eliminata!')->with('alert_text', 'Scheda offerta rimossa!');
        ;
    }

    protected function validateOffer()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'preview_title' => 'required',
            'preview_subtitle' => 'required',
            'beginning' => 'required|date|after_or_equal:today',
            'expiration' => 'required|date|after_or_equal:beginning',
            'image_path' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
    }

    protected function validateOfferNoImg()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'preview_title' => 'required',
            'preview_subtitle' => 'required',
            'beginning' => 'required|date|after_or_equal:today',
            'expiration' => 'required|date|after_or_equal:beginning'
        ]);
    }

    protected function uploadImage($imageuploaded)
    {
        $imagename = time() . '_offer.' . $imageuploaded->extension();
        $storepath = config('app.local_public_path') . 'img/offers';
        $imageresized = ImageResize::make($imageuploaded->path());
        $imageresized->resize(250, 170)->save($storepath . '/' . $imagename);
        // $imageresized->resize(250, 170, function ($constraint) {
        //     // $constraint->aspectRatio();
        //     $constraint->upsize();
        // })->save($storepath.'/'.$imagename);
        return $imagename;
    }
}
