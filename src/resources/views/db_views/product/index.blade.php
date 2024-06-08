@extends ('layouts.db')

@section ('main_content_page')
    <div class='row'>
        <div class='col-12'>
            <h3 class='section_title'>Lista prodotti</h3>
            <hr class='styled-hr'>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-2 col-md-1'>
            <a role="button" class="btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi" href="{{ route('product.create') }}"><i class="fas fa-plus"></i></a>
        </div>
        <div class='col-sm-9 col-md-11'>
        <div id="accordion" class="filters">
            <div class="card">
                <div class="card-header" id="headingRef">
                    <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseRef" aria-expanded="true" aria-controls="collapseRef">
                        <i class="fas fa-chevron-down"></i> Filtri di ricerca
                    </button>
                    </h5>
                </div>
                <div id="collapseRef" class="collapse" aria-labelledby="headingRef" data-parent="#accordion">
                    <div class="card-body">
                        <form method='GET' action='{{ route("product.index") }}'>
                        @csrf
                        <div class='form-row'> 
                          <div class="form-group col-12 col-md-5">
                            <label class='db_form_label' for="type">Tipo</label>
                            <select class="selectpicker show-tick form-control" data-size="5" id="type" name="type">
                              <option value='unselected'>Seleziona tipo prodotto</option>
                              <option data-divider="true"></option>
                              @foreach($types as $type)
                                <option value="{{$type}}" {{$old_type == $type ? 'selected' : ''}}>{{$type}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group col-12 col-md-5">
                            <label class='db_form_label' for="category">Categoria</label>
                            <select class="selectpicker show-tick form-control" data-size="5" name="category" id="category">
                              <option value='unselected'>Seleziona categoria prodotto</option>
                              <option data-divider="true"></option>
                              @foreach($categories as $category)
                                <option value="{{$category}}" {{$old_cat == $category ? 'selected' : ''}}>{{$category}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class='col-2 col-md-2' style='padding-top:1.75rem'>
                            <button type="submit" class="btn btn-dark-blue-out"><i class="fas fa-search"></i> Applica</button>
                        </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        {{-- <div class='col-sm-8 col-md-10'>
            <input class="form-control" type="text" placeholder="Cerca...">
        </div>
        <div class='col-sm-2 col-md-1'>
            <button type="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Trova" href="#"><i class="fas fa-search"></i></button>
        </div> --}}
    </div>
    <div class='table-responsive' id='products_table' style='padding-top: 20px;'>
        <table class="table table-hover">
        <thead>
            <tr class="bg-table-header">
                <th scope="col">Nome</th>
                <th scope="col">Codice</th>
                <th scope="col">Tipo</th>
                <th scope="col">Categoria</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <th scope="row">{{ $product -> name }}</th>
                <td>{{ $product -> code}}</td>
                <td>{{ $product -> type }}</td>
                <td>{{ $product -> category }}</td>
                <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('product.show', $product -> id ) }}"><i class="far fa-eye"></i></a></td>
                <td><a class = "btn btn-dark-blue-out  btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('product.edit', $product -> id ) }}"><i class="far fa-edit"></i></a></td>
                <td><a class = "btn btn-dark-green-out  btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Crea acquisto" href = "{{route ('purchase.create', ["product_id"=>$product->id] ) }}"><i class="fas fa-shopping-cart"></i></a></td>
                <td><form class='delete_form' id='{{$product->id}}_delete_form' action="{{ route('product.delete', $product->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$product->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @empty
                <tr> 
                        <th scope="row" colspan="8">Nessun prodotto</th>
                    </tr>
            @endforelse
        </tbody>
        </table>
    </div>
<script>
    $(document).ready(function () {
    $("#collapseRef").on("hide.bs.collapse", function () {
        $(".btn-link").html('<i class="fas fa-chevron-down"></i>  Filtri di ricerca');
    });
    $("#collapseRef").on("show.bs.collapse", function () {
        $(".btn-link").html('<i class="fas fa-chevron-up"></i>  Filtri di ricerca');
    });
});
</script>  
@endsection