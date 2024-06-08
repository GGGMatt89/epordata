@extends ('layouts.db')

@section ('main_content_page')
    <div class="jumbotron" style="width: 80%; margin: auto">
        <div class="container">
            <div class='row'>
                <div class='col-12 col-lg-9'>
                    <h3 class="section_title">Dettagli corso / seminario</h3>
                </div>
                <div class='col-2 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-red-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Vedi iscritti" href="{{ route('participant.index', ["lecture_id"=>$lecture->id]) }}"><i class="fas fa-chalkboard-teacher"></i></a>
                </div>
                <div class='col-2 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('lecture.edit', $lecture->id) }}"><i class="far fa-edit"></i></a>
                </div>
                <div class='col-2 col-lg-1 mx-auto'>
                    <form class='delete_form' id='{{$lecture->id}}_delete_form' action="{{ route('lecture.delete', $lecture->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$lecture->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
            <div class='row'>
                <hr class='show-sep'>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Titolo:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    <p class="lead">{{ $lecture->title }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Descrizione:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    <p class="lead">{{ $lecture->description }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Inizio il </p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ date("d-m-Y", strtotime($lecture->beginning))}}</p>
                </div>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">alle ore </p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ date("H:i", strtotime($lecture->beginning))}}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Fine il </p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ date("d-m-Y", strtotime($lecture->end))}}</p>
                </div>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">alle ore </p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ date("H:i", strtotime($lecture->end))}}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Durata totale:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    <p class="lead">{{ $lecture->last }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Luogo:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    <p class="lead">{{ $lecture->place }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">C.F.P. :</p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ $lecture->cfp }}</p>
                </div>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in"><i class="fas fa-wallet"></i> Prezzo :</p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ $lecture->price }} <i class="fas fa-euro-sign"></i></p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Ente accreditante :</p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ $lecture->cr_body }}</p>
                </div>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Fornitore :</p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ $lecture->provider }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Collegato al prodotto:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    @if($lecture->product)
                    <p class="lead">{{ $lecture->product->name }} - {{ $lecture->product->code }}</p>
                    @else
                    <p class="lead">Nessun prodotto collegato</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
