@extends ('layouts.db')

@section ('main_content_page')
    <div class='row'>
        <div class='col-12'>
            <h3 class='section_title'>Lista clienti</h3>
            <hr class='styled-hr'>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-2 col-md-1'>
            <a role="button" class="btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi" href="{{ route('customer.create') }}"><i class="fas fa-plus"></i></a>
        </div>
        <div class='col-sm-9 col-md-11'>
            <div class="accordion filters" id="accordion">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingRef">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRef" aria-expanded="true" aria-controls="collapseRef">
                        Filtri di ricerca
                    </button>
                  </h2>
                  <div id="collapseRef" class="accordion-collapse collapse" aria-labelledby="headingRef" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        <form method='GET' action='{{ route("customer.index") }}'>
                            @csrf
                            <div class='form-row'>
                              <div class="form-group col-12 col-md-6">
                                <label class='db_form_label' for="category">Categoria</label>
                                <select class="selectpicker show-tick form-control" data-size="5" name="category" id="category">
                                  <option value='unselected'>Seleziona categoria cliente</option>
                                  <option data-divider="true"></option>
                                  @foreach($categories as $category)
                                    <option value="{{$category}}" {{$old_cat == $category ? 'selected' : ''}}>{{$category}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-12 col-md-6">
                                <label class='db_form_label' for="handler">Curatore</label>
                                <select class="selectpicker show-tick form-control" data-size="5" id="handler" name="handler">
                                  <option value='unselected'>Seleziona curatore cliente</option>
                                  <option data-divider="true"></option>
                                  @foreach($handlers as $handler)
                                    <option value="{{$handler}}" {{$old_handler == $handler ? 'selected' : ''}}>{{$handler}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class='form-row'>
                              <div class="form-group col-12 col-md-4">
                                <label class='db_form_label' for="region">Provincia</label>
                                <select class="selectpicker show-tick form-control" data-size="5" name="region" id="region">
                                  <option value='unselected'>Seleziona provincia cliente</option>
                                  <option data-divider="true"></option>
                                  @foreach($regions as $region)
                                    <option value="{{$region}}" {{$old_region == $region ? 'selected' : ''}}>{{$region}}</option>
                                  @endforeach
                                </select>
                              </div>
                            <div class="form-group col-12 col-md-4">
                                <label class='db_form_label' for="rating">Rating</label>
                                <select class="selectpicker show-tick form-control" data-size="5" id="rating" name="rating">
                                  <option value='unselected'>Seleziona rating cliente</option>
                                  <option data-divider="true"></option>
                                  @foreach($ratings as $rating)
                                    <option value="{{$rating}}" {{$old_rating == $rating ? 'selected' : ''}}>{{$rating}}</option>
                                  @endforeach
                                </select>
                              </div>
                            <div class="form-check col-12 col-md-4">
                                <div class="checkbox-container filter-checkbox">
                                    <p class='db_form_label input-title'>Solo personali?</p>
                                    <label class="checkbox-label" for="personal">
                                        <input type="checkbox" name="personal" id="personal" {{ $old_personal ? 'checked' : ''}}>
                                        <span class="checkbox-custom rectangular"></span>
                                    </label>
                                </div>
                            </div>
                            </div>
                            <div class='form-row'>
                                <div class='col-2 col-md-2 my-auto'>
                                    <button type="submit" class="btn btn-dark-blue-out"><i class="fas fa-search"></i> Cerca</button>
                                </div>
                            </div>
                            </form>
                        </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class='table-responsive' id='customers_table'>
        <table class="table table-hover align-middle">
            <thead>
            <tr class="bg-table-header">
            <th scope="col">Cognome</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Città</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                <tr>
                <th scope="row">{{ $customer -> last_name }}</th>
                <td>{{ $customer -> first_name}}</td>
                <td>{{ $customer -> email }}</td>
                <td>{{ $customer -> city }}</td>
                <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('customer.show', $customer -> id ) }}"><i class="far fa-eye"></i></a></td>
                <td><a class = "btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('customer.edit', $customer -> id ) }}"><i class="far fa-edit"></i></a></td>
                <td><a class = "btn btn-dark-green-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Crea acquisto" href = "{{route ('purchase.create', ["customer_id"=>$customer->id]) }}"><i class="fas fa-shopping-cart"></i></a></td>
                <td><a class = "btn btn-dark-red-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Iscrivi a corso" href = "{{route ('participant.create', ["customer_id"=>$customer->id]) }}"><i class="fas fa-chalkboard-teacher"></i></a></td>
                {{-- <td><form class='delete_form' id='{{$customer->id}}_delete_form' action="{{ route('customer.delete', $customer->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type='button' class="btn btn-primary btn-tooltip delete_form_btn" data-toggle="tooltip" data-placement="bottom" title="Elimina" onclick='deleteEntry({{$customer->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </td> --}}
                <td><a class = "btn btn-orange-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Vedi appuntamenti" href = "{{route ('customer.listMeetings', $customer -> id ) }}"><i class="far fa-handshake"></i></a></td>
                </tr>
                @empty
                    <tr>
                        <th scope="row" colspan="9">Nessun cliente</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
