<?php

namespace App\Http\Controllers;

use App\Product;
use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public $types = ['Editoria', 'Formazione'];
    public $categories = ['Vendita beni', 'Archiviazione', 'Editoria', 'Software', 'Formazione'];

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
        $products = (new Product)->newQuery();//::all()->sortBy('name');
        $old_cat = null;
        $old_type = null;
        if ($request->has('category')) {
            if ($request->category != 'unselected') {
                $old_cat = $request->category;
                $products->where('category', $request->category);
            }
        }
        if ($request->has('type')) {
            if ($request->type != 'unselected') {
                $old_type = $request->type;
                $products->where('type', $request->type);
            }
        }
        $sel_products = $products->get()->sortBy('name');

        return view('db_views.product.index', [
            'products' => $sel_products, 'types' => $this->types, 'categories' => $this->categories
        ])->with(['old_cat' => $old_cat, 'old_type' => $old_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::all();
        return view('db_views.product.create', ['providers' => $providers, 'types' => $this->types, 'categories' => $this->categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create($this->validateProduct());
        return redirect()->route('product.index')->with('success_create', 'Salvato!')->with('alert_text', 'Nuovo prodotto inserito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('db_views.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $providers = Provider::all();
        return view('db_views.product.edit', ['product' => $product, 'providers' => $providers, 'types' => $this->types, 'categories' => $this->categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedUpdate = $this->validateProduct($product);
        $product->update($validatedUpdate);
        return redirect()->route('product.index')->with('success_create', 'Salvato!')->with('alert_text', 'Scheda prodotto modificata!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success_delete', 'Eliminato!')->with('alert_text', 'Prodotto rimosso!');
        ;
    }

    protected function validateProduct()
    {
        $validatedFields = request()->validate([
            'name' => 'required|max:100',
            'code' => 'required|alpha_num',
            'type' => ['required', Rule::in(['', 'Editoria', 'Formazione'])],
            'category' => ['nullable', Rule::in(['', 'Vendita beni', 'Archiviazione', 'Editoria', 'Software', 'Formazione'])],
            'provider_name' => 'nullable',
            'provider_id' => 'nullable'
        ]);
        if (request('type') == '') {
            $validatedFields['type'] = null;
        }
        if (request('category') == '') {
            $validatedFields['category'] = null;
        }
        if (request('provider_id') == '') {
            $validatedFields['provider_id'] = null;
        }
        return $validatedFields;
    }
}
