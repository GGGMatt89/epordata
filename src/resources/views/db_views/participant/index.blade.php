@extends ('layouts.db')

@section ('main_content_page')
    <div class='row'>
        <div class='col-12'>  
            @if(isset($page_title))
                <h5 class='section_title'>{{ $page_title }}</h5>  
            @endif
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-2 col-md-1'>
            <a role="button" class="btn btn-dark-red-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Crea nuovo" href="{{route ('participant.create', ["customer_id"=>$customer_id, "lecture_id"=>$lecture_id]) }}"><i class="fas fa-plus"></i></a>
        </div>
        {{-- <div class='col-sm-8 col-md-10'>
            <input class="form-control" type="text" placeholder="Cerca...">
        </div>
        <div class='col-sm-2 col-md-1'>
            <button type="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Trova" href="#"><i class="fas fa-search"></i></button>
        </div> --}}
    </div>
    <div class='table-responsive' id='participants_table' style='padding-top: 20px;'>
        <table class="table table-hover">
        <thead>
            <tr class="bg-table-header">
                <th scope="col">{{ $table_title }}</th>
                <th scope="col">Ruolo</th>
                <th scope="col">Pagato?</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($participants as $participant)
            <tr>
                @if(isset($customer_id))
                    <th scope="row">{{ $participant->lecture->title }}</th>
                @endif
                @if(isset($lecture_id))
                    <th scope="row">{{ $participant->last_name }} {{ $participant->first_name }}</th>  
                @endif
                @if(!isset($customer_id) && !isset($lecture_id))
                    <th scope="row">{{ $participant->last_name }} <br> {{ $participant->lecture->title }}</th>    
                @endif
                <td>{{ $participant->role }}</td>
                <td class={{ $participant->payed ? 'checked-td' : 'unchecked-td'}}>
                @if($participant->payed)
                <i class="far fa-check-circle"></i>
                @else
                <i class="far fa-circle"></i>
                @endif
                </td>
                <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('participant.show', $participant->id ) }}"><i class="far fa-eye"></i></a></td>
                <td><a class = "btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('participant.edit', $participant->id ) }}"><i class="far fa-edit"></i></a></td>
                <td><form class='delete_form' id='{{$participant->id}}_delete_form' action="{{ route('participant.delete', $participant->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$participant->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </td></tr>
            @empty
                <tr> 
                    <th scope="row" colspan="6">Nessun iscritto</th>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
@endsection