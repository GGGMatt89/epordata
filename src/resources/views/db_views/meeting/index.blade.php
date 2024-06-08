@extends ('layouts.db')

@section ('main_content_page')
    <div class='row'>
        <div class='col-12'>
            <h3 class='section_title'>Lista appuntamenti</h3>
            <hr class='styled-hr'>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-2 col-md-1'>
            <a role="button" class="btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi" href="{{ route('meeting.create') }}"><i class="fas fa-plus"></i></a>
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
                            <form method='GET' action='{{ route("meeting.index") }}'>
                            @csrf
                            <div class='form-row'>
                            <div class="form-group col-10 col-md-8">
                                <label class='db_form_label' for="customer">Cliente</label>
                                <select class="selectpicker show-tick form-control" data-size="5" name="customer" id="customer">
                                <option value='unselected'>Seleziona cliente</option>
                                <option data-divider="true"></option>
                                @foreach($customers as $customer)
                                    <option value={{$customer->id}} {{$old_cust == $customer->id ? 'selected' : ''}}>{{$customer->title}} {{$customer->first_name}} {{$customer->last_name}}</option>
                                @endforeach
                                </select>
                            </div>

                            </div>
                            <div class='form-row'>
                            <div class="form-check col-2 col-md-4">
                                <div class="checkbox-container filter-checkbox">
                                    <p class='db_form_label input-title'>Solo futuri?</p>
                                    <label class="checkbox-label" for="future">
                                        <input type="checkbox" name="future" id="future" {{ $old_future ?? '' ? 'checked' : ''}}>
                                        <span class="checkbox-custom rectangular"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-check col-2 col-md-4">
                                <div class="checkbox-container filter-checkbox">
                                    <p class='db_form_label input-title'>Solo personali?</p>
                                    <label class="checkbox-label" for="personal">
                                        <input type="checkbox" name="personal" id="personal" {{ $old_personal ?? '' ? 'checked' : ''}}>
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
    <div class='table-responsive' id='meetings_table' style='padding-top: 20px;'>
        <table class="table table-hover">
        <thead>
            <tr class="bg-table-header">
                <th scope="col" colspan="7">Appuntamenti personali</th>
            </tr>
        </thead>
        <thead>
            <tr class="bg-table-header">
            <th scope="col">Data e Ora</th>
            <th scope="col">Da</th>
            <th scope="col">Indirizzo</th>
            <th scope="col">Agente</th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($personal_meetings as $meeting)
                <tr>
                <th scope="row">{{ Carbon\Carbon::parse($meeting->scheduled_at)->format('d-m-Y') }} <br> {{ Carbon\Carbon::parse($meeting->scheduled_at)->format('H:i') }}</th>
                <td>{{ $meeting -> cust_name}} {{ $meeting -> cust_surname}}</td>
                <td>
                @if($meeting -> remote)
                Online/telefonico
                @else
                {{ $meeting -> meet_address }}
                @endif
                </td>
                <td>{{ $meeting -> user -> profile -> first_name }} {{ $meeting -> user -> profile -> last_name }}</td>
                <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('meeting.show', $meeting -> id ) }}"><i class="far fa-eye"></i></a></td>
                <td><a class = "btn btn-dark-blue-out  btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('meeting.edit', $meeting -> id ) }}"><i class="far fa-edit"></i></a></td>
                <td><form class='delete_form' id='{{$meeting->id}}_delete_form' action="{{ route('meeting.delete', $meeting->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$meeting->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
                </tr>
            @empty
                <tr>
                    <th scope="row" colspan="7">Nessun appuntamento</th>
                </tr>
            @endforelse
        </tbody>
        @if($meetings->count() > 0)
        <thead>
            <tr class="bg-table-header">
                <th scope="col" colspan="7">Appuntamenti altrui</th>
            </tr>
        </thead>
        <thead>
            <tr class="bg-table-header">
            <th scope="col">Data e Ora</th>
            <th scope="col">Da</th>
            <th scope="col">Indirizzo</th>
            <th scope="col">Agente</th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meetings as $meeting)
                <tr>
                <th scope="row">{{ Carbon\Carbon::parse($meeting->scheduled_at)->format('d-m-Y') }} <br> {{ Carbon\Carbon::parse($meeting->scheduled_at)->format('H:i') }}</th>
                <td>{{ $meeting -> cust_name}} {{ $meeting -> cust_surname}}</td>
                <td>
                @if($meeting -> remote)
                Online/telefonico
                @else
                {{ $meeting -> meet_address }}
                @endif
                </td>
                <td>{{ $meeting -> user -> profile -> first_name }} {{ $meeting -> user -> profile -> last_name }}</td>
                <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('meeting.show', $meeting -> id ) }}"><i class="far fa-eye"></i></a></td>
                <td><a class = "btn btn-dark-blue-out  btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('meeting.edit', $meeting -> id ) }}"><i class="far fa-edit"></i></a></td>
                <td><form class='delete_form' id='{{$meeting->id}}_delete_form' action="{{ route('meeting.delete', $meeting->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$meeting->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
        @endif
        </table>
    </div>
@endsection
