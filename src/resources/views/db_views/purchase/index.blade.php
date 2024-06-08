@extends ('layouts.db')

@section ('main_content_page')
    <div class='row'>
        <div class='col-12'>  
            <h3 class='section_title'>Acquisti / abbonamenti</h3>
            @if(isset($page_title))
                <h5 class='section_title'>{{ $page_title }}</h5>  
            @endif
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-2 col-md-1'>
            <a role="button" class="btn btn-dark-green-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi acquisto" href="{{route ('purchase.create', ["customer_id"=>$customer_id, "product_id"=>$product_id]) }}"><i class="fas fa-plus"></i></a>
        </div>
        {{-- <div class='col-sm-8 col-md-10'>
            <input class="form-control" type="text" placeholder="Cerca...">
        </div>
        <div class='col-sm-2 col-md-1'>
            <button type="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Trova" href="#"><i class="fas fa-search"></i></button>
        </div> --}}
    </div>
    <div class='table-responsive' id='purchases_table' style='padding-top: 20px;'>
        <table class="table table-hover">
        <thead>
            <tr class="bg-table-header">
                <th scope="col">{{ $table_title }}</th>
                <th scope="col">Tipo</th>
                <th scope="col">Scadenza abbonamento</th>
                <th scope="col">Note/Dettagli</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($purchases as $purchase)
            <tr>
                @if(isset($customer_id))
                    <th scope="row">{{ $purchase->product->name }}</th>
                @endif
                @if(isset($product_id))
                    <th scope="row">{{ $purchase->customer->title }} {{ $purchase->customer->last_name }}</th>  
                @endif
                @if(!isset($customer_id) && !isset($product_id))
                    <th scope="row">{{ $purchase->customer->title }} {{ $purchase->customer->last_name }} <br> {{ $purchase->product->name }}</th>    
                @endif
                <td>{{ $purchase->type }}</td>
                <td>{{ $purchase->expiration }}</td>
                <td>{{ $purchase->notes }}</td>
                <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('purchase.show', $purchase->id ) }}"><i class="far fa-eye"></i></a></td>
                <td><a class = "btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('purchase.edit', $purchase->id ) }}"><i class="far fa-edit"></i></a></td>
                <td><form class='delete_form' id='{{$purchase->id}}_delete_form' action="{{ route('purchase.delete', $purchase->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$purchase->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </td></tr>
            @empty
                <tr> 
                    <th scope="row" colspan="7">Nessun acquisto/abbonamento</th>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
@endsection