@extends ('layouts.db')

@section ('main_content_page')
    <div class="jumbotron" style="width: 80%; margin: auto; padding: 10px;">
      <div class="container">
          <div class='row'>
                <div class='col-12 col-lg-9'>
                    <h3 class="section_title">{{$product->name}}</h3>
                </div>
                <div class='col-3 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-green-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Vedi clienti" href="{{ route('purchase.index', ["product_id"=>$product->id]) }}"><i class="fas fa-shopping-cart"></i></a>
                </div>
                <div class='col-3 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('product.edit', $product->id) }}"><i class="far fa-edit"></i></a>
                </div>
                <div class='col-3 col-lg-1 mx-auto'>
                    <form class='delete_form' id='{{$product->id}}_delete_form' action="{{ route('product.delete', $product->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$product->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
            <div class='row d-flex justify-content-center'>
                <hr class='show-sep'>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4">
                      <p class="lead lead-in">Codice prodotto: </p>
                  </div>
                <div class="form-group col-12 col-md-8">
                    <p class="lead">{{ $product->code }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Tipo: </p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $product->type }}</p>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Categoria: </p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $product->category }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4">
                    <p class="lead lead-in">Fornito da: </p>
                </div>
                <div class="form-group col-12 col-md-8">
                    <p class="lead">{{ $product->provider_name }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
