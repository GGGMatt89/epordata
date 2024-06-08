@extends ('layouts.db')

@section ('main_content_page')  
    <div class="jumbotron" style="width: 80%; margin: auto">
        <div class="container">
            <div class='row'>
                <div class='col-12 col-lg-10'>
                    <h5 class="section_title">Cliente {{$purchase->customer->title}} {{ $purchase->customer->first_name }} {{$purchase->customer->last_name}}</h5>
                    <h5 class="section_title">Prodotto {{$purchase->product->name}} {{ $purchase->product->code }} </h5>
                </div>
                <div class='col-3 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('purchase.edit', $purchase->id) }}"><i class="far fa-edit"></i></a> 
                </div>    
                <div class='col-3 col-lg-1 mx-auto'>
                    <form class='delete_form' id='{{$purchase->id}}_delete_form' action="{{ route('purchase.delete', $purchase->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$purchase->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>    
            </div>
            <div class='row'>
                <hr class='show-sep'>  
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <p class="lead lead-in">Tipo:</p>
                </div> 
                <div class="form-group col-12 col-md-8 col-lg-9">
                    <p class="lead">{{ $purchase->type }}</p>
                </div>
            </div>
            @if ($purchase->type == 'Abbonamento')
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <p class="lead lead-in">Scadenza:</p>
                </div> 
                <div class="form-group col-12 col-md-8 col-lg-9">
                    <p class="lead">{{ $purchase->expiration }}</p>
                </div>
            </div>
            @endif
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Note/dettagli:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $purchase->notes }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Inserito il:</p>
                </div>  
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $purchase->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection 
