@extends ('layouts.db')

@section ('main_content_page')  
    <div class="jumbotron" style="width: 80%; margin: auto">
        <div class="container">
            <div class='row'>
                <div class='col-12 col-lg-10'>
                    <h4 class="section_title">Cliente {{$participant->last_name}} {{ $participant->first_name }}</h4>
                    <h4 class="section_title">Corso/Seminario {{$participant->lecture->title}}</h4>
                </div>
                <div class='col-3 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('participant.edit', $participant->id) }}"><i class="far fa-edit"></i></a> 
                </div>    
                <div class='col-3 col-lg-1 mx-auto'>
                    <form class='delete_form' id='{{$participant->id}}_delete_form' action="{{ route('participant.delete', $participant->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$participant->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>    
            </div>
            <div class='row'>
                <hr class='show-sep'>  
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <p class="lead lead-in">Ruolo:</p>
                </div> 
                <div class="form-group col-12 col-md-8 col-lg-9">
                    <p class="lead">{{ $participant->role }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <p class="lead lead-in">Pagato?</p>
                </div> 
                <div class="form-group col-12 col-md-8 col-lg-9">
                    @if($participant->payed)
                    <p class="lead" style="color:green; font-size:1.7rem"><i class="far fa-check-circle"></i></p>
                    @else 
                    <p class="lead" style="color:red; font-size:1.7rem"><i class="far fa-circle"></i></p>
                    @endif
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Inserito il:</p>
                </div>  
                <div class="form-group col-12 col-md-8 col-lg-10">
                    <p class="lead">{{ $participant->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection 
