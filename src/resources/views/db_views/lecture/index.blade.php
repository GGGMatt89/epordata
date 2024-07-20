@extends ('layouts.db')

@section ('main_content_page')
    <div class='row'>
        <div class='col-12'>
            <h3 class='section_title'>Lista corsi/seminari</h3>
            <hr class='styled-hr'>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-2 col-md-1'>
            <a role="button" class="btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi" href="{{ route('lecture.create') }}"><i class="fas fa-plus"></i></a>
        </div>
    </div>
    <div class='table-responsive' id='lectures_table'>
        <table class="table table-hover align-middle">
        <thead>
            <tr class="bg-table-header">
            <th scope="col">Titolo</th>
            <th scope="col">Da</th>
            <th scope="col">A</th>
            <th scope="col">Luogo</th>
            <th scope="col">C.F.P.</th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lectures as $lecture)
                <tr>
                <th scope="row">{{ $lecture->title }}</th>
                <td>{{ Carbon\Carbon::parse($lecture->beginning)->format('d-m-Y') }} <br> {{ Carbon\Carbon::parse($lecture->beginning)->format('H:i') }}</td>
                <td>{{ Carbon\Carbon::parse($lecture->end)->format('d-m-Y') }} <br> {{ Carbon\Carbon::parse($lecture->end)->format('H:i') }}</td>
                <td>{{ $lecture -> place}}</td>
                <td>{{ $lecture -> cfp }}</td>
                <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('lecture.show', $lecture -> id ) }}"><i class="far fa-eye"></i></a></td>
                <td><a class = "btn btn-dark-blue-out  btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('lecture.edit', $lecture -> id ) }}"><i class="far fa-edit"></i></a></td>
                <td><a class = "btn btn-dark-red-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi partecipante" href = "{{route ('participant.create', ["lecture_id"=>$lecture->id]) }}"><i class="fas fa-chalkboard-teacher"></i></a></td>
                <td><form class='delete_form' id='{{$lecture->id}}_delete_form' action="{{ route('lecture.delete', $lecture->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$lecture->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
                </tr>
              @empty
                  <tr>
                      <th scope="row" colspan="9">Nessun corso/seminario</th>
                  </tr>
              @endforelse
        </tbody>
        </table>
    </div>
@endsection
