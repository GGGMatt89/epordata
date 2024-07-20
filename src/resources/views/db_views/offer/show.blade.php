@extends ('layouts.db')

@section ('main_content_page')
    <div class="jumbotron" style="width: 80%; margin: auto; padding: 10px;">
      <div class="container">
        <div class='row'>
            <div class='col-12 col-lg-10'>
                <h3 class="section_title">{{$offer->title}} </h3>
            </div>
            <div class='col-3 col-lg-1 mx-auto'>
               <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('offer.edit', $offer->id) }}"><i class="far fa-edit"></i></a>
            </div>
            <div class='col-3 col-lg-1 mx-auto'>
                <form class='delete_form' id='{{$offer->id}}_delete_form' action="{{ route('offer.delete', $offer->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$offer->id}})'><i class="far fa-trash-alt"></i></button>
                </form>
            </div>
        </div>
        <div class='row d-flex justify-content-center'>
            <hr class='show-sep'>
        </div>
        @if(Carbon\Carbon::parse($offer -> expiration) < Carbon\Carbon::now())
        <div class='row'>
            <div class="form-group col-12 text-center" style='background-color:#7e2a2a; padding-top:10px'>
                <p class="lead lead-in" style='color:#fff'>SCADUTA</p>
            </div>
        </div>
        @endif
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Estratto:</p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $offer->excerpt }}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Testo:</p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $offer->body }}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Titolo anteprima: </p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $offer->preview_title }}</p>
            </div>
            <div class="form-group col-2">
                <p class="lead lead-in">Sottotitolo anteprima: </p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $offer->preview_subtitle }}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-2 col-lg-2">
                <p class="lead lead-in">Inizio il </p>
            </div>
            <div class="form-group col-10 col-lg-4">
                <p class="lead">{{ date("d-m-Y", strtotime($offer->beginning))}}</p>
            </div>
            <div class="form-group col-2 col-lg-2">
                <p class="lead lead-in">fino al </p>
            </div>
            <div class="form-group col-10 col-lg-4">
                <p class="lead">{{ date("d-m-Y", strtotime($offer->expiration))}}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-12 d-flex justify-content-center">
                <div class="preview-container">
                    <img id="previewHolder" width="250px" height="170px" src='{{ $offer->image_path }}'/>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection
