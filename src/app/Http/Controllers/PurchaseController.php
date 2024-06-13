<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    var $types = array('Singolo', 'Abbonamento');

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
            $purchases = Purchase::where('customer_id', request('customer_id'))->get();
            $customer_id = request('customer_id');
            $product_id = null;
            $customer = Customer::where('id', request('customer_id'))->firstOrFail();
            $page_title = $customer->title." ".$customer->first_name." ".$customer->last_name;
            $table_title = "Prodotto";
        }
        else if(request('product_id')){
            $purchases = Purchase::where('product_id', request('product_id'))->get();
            $product_id = request('product_id');
            $customer_id = null;
            $product = Product::where('id', request('product_id'))->firstOrFail();
            $page_title = $product->name." ".$product->code;
            $table_title = "Cliente";
        }
        else{
            $purchases = Purchase::all();
            $customer_id = null;
            $product_id = null;
            $page_title = null;
            $table_title = "Cliente - prodotto";
        }

        return view('db_views.purchase.index', ['purchases'=>$purchases, 'customer_id'=>$customer_id, 'product_id'=>$product_id, 'page_title'=>$page_title, 'table_title'=>$table_title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request('customer_id')){
            $products = Product::all();
            $customers = Customer::where('id', request('customer_id'))->firstOrFail();
            $page_title = $customers->title." ".$customers->first_name." ".$customers->last_name;
            $assoc = 'customer';
        }
        else if(request('product_id')){
            $products = Product::where('id', request('product_id'))->firstOrFail();
            $customers = Customer::all();
            $page_title = $products->name." ".$products->code;
            $assoc = 'product';
        }
        else{
            $products = Product::all();
            $customers = Customer::all();
            $page_title = '';
            $assoc = null;
        }
        return view('db_views.purchase.create', ['assoc'=> $assoc, 'page_title'=>$page_title, 'customers' => $customers, 'products'=>$products, 'types'=>$this->types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validatePurchase();
        $model_comp = [
            'customer_id'=>$validated['customer_id'],
            'type'=>$validated['type'],
            'expiration'=>$validated['expiration'],
            'notes'=>$validated['notes']
        ];
        if($validated['product_id_ed'] <> ' '){
            $model_comp['product_id'] = $validated['product_id_ed'];
        }
        else if($validated['product_id_form' <> ' ']){
            $model_comp['product_id'] = $validated['product_id_form'];
        }
        Purchase::create($model_comp);
        return redirect()->route('purchase.index', ['product_id'=>$model_comp['product_id']])->with('success_create', 'Salvato!')->with('alert_text', 'Nuovo acquisto/abbonamento inserito!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('db_views.purchase.show', ['purchase' => $purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        return view('db_views.purchase.edit', ['purchase' => $purchase, 'types'=>$this->types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $purchase->update($this->validatePurchaseFromEdit());
        return redirect()->route('purchase.index', ['product_id'=>$purchase->product_id])->with('success_create', 'Salvato!')->with('alert_text', 'Acquisto/abbonamento aggiornato!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {   $product = $purchase->product;
        $purchase->delete();
        return redirect()->route('purchase.index', ['product_id'=>$product->id])->with('success_create', 'Eliminato!')->with('alert_text', 'Acquisto/abbonamento rimosso!');;
    }

    protected function validatePurchase()
    {
        $validatedFields =  request()->validate([
            'customer_id'=>'required',
            'product_id_ed'=>'required_if:product_id_form, " "',
            'product_id_form'=>'required_if:product_id_ed, " "',
            'type'=>['required', 'string', Rule::in($this->types)],
            'expiration'=>'required_if:type,Abbonamento|date|after_or_equal:today',
            'notes'=>'nullable'
        ]);
        if(!isset($validatedFields['expiration'])){
            $validatedFields['expiration'] = null;
        }
        return $validatedFields;
    }

    protected function validatePurchaseFromEdit()
    {
        $validatedFields =  request()->validate([
            'customer_id'=>'required',
            'product_id'=>'required',
            'type'=>['required', 'string', Rule::in($this->types)],
            'expiration'=>'required_if:type,Abbonamento|date|after_or_equal:today',
            'notes'=>'nullable'
        ]);
        if(!isset($validatedFields['expiration'])){
            $validatedFields['expiration'] = null;
        }
        return $validatedFields;
    }
}
