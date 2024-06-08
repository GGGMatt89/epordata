@extends ('layouts.db')

@section ('main_content_page')
    <div class='row'>
        <div class='col-12'>
            <h3 class='section_title'>Lista fornitori</h3>
            <hr class='styled-hr'>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-2 col-md-1'>
            <a role="button" class="btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi" href="{{ route('provider.create') }}"><i class="fas fa-plus"></i></a>
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
                        <form method='GET' action='{{ route("provider.index") }}'>
                        @csrf
                        <div class='form-row'> 
                          <div class="form-group col-12 col-md-5">
                            <label class='db_form_label' for="category">Categoria</label>
                            <select class="selectpicker show-tick form-control" data-size="5" name="category" id="category">
                              <option value='unselected'>Seleziona categoria fornitore</option>
                              <option data-divider="true"></option>
                              @foreach($categories as $category)
                                <option value="{{$category}}" {{$old_cat == $category ? 'selected' : ''}}>{{$category}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group col-12 col-md-5">
                            <label class='db_form_label' for="region">Provincia</label>
                            <select class="selectpicker show-tick form-control" data-size="5" id="region" name="region">
                              <option value='unselected'>Seleziona provincia fornitore</option>
                              <option data-divider="true"></option>
                              @foreach($regions as $region)
                                <option value="{{$region}}" {{$old_region == $region ? 'selected' : ''}}>{{$region}}</option>
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
    <div class='table-responsive' id='providers_table' style='padding-top: 20px;'>
        <table class="table table-hover">
            <thead>
            <tr class="bg-table-header">
            <th scope="col">Nome/RS</th>
            <th scope="col">Categoria</th>
            <th scope="col">Email</th>
            <th scope="col">Città</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @forelse ($providers as $provider)
                <tr>
                    <th scope="row">{{ $provider -> bus_name }}</th>
                    <td>{{ $provider -> category}}</td>
                    <td>{{ $provider -> email }}</td>
                    <td>{{ $provider -> city }}</td>
                    <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('provider.show', $provider -> id ) }}"><i class="far fa-eye"></i></a></td>
                    <td><a class = "btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('provider.edit', $provider -> id ) }}"><i class="far fa-edit"></i></a></td>
                    <td><form class='delete_form' id='{{$provider->id}}_delete_form' action="{{ route('provider.delete', $provider->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$provider->id}})'><i class="far fa-trash-alt"></i></button>
                        </form>
                    </td>
                    </tr>
                @empty
                    <tr> 
                        <th scope="row" colspan="7">Nessun fornitore</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
