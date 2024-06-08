@extends ('layouts.db')

@section ('main_content_page')
    <div class="jumbotron" style="width: 80%; margin: auto">
      <div class="container">
        <div class='row'>
            <div class='col-12 col-lg-10'>
                <h3 class="section_title">{{$news->title}} </h3>
            </div>
            <div class='col-3 col-lg-1 mx-auto'>
               <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('news.edit', $news->id) }}"><i class="far fa-edit"></i></a> 
            </div>    
            <div class='col-3 col-lg-1 mx-auto'>
                <form class='delete_form' id='{{$news->id}}_delete_form' action="{{ route('news.delete', $news->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$news->id}})'><i class="far fa-trash-alt"></i></button>
                </form>
            </div>    
        </div>
        <div class='row'>
            <hr class='show-sep'>  
        </div>
        @if(Carbon\Carbon::parse($news -> date) > Carbon\Carbon::now())
        <div class='row'>
            <div class="form-group col-12 text-center" style='background-color:#2a7e2a; padding-top:10px'>
                <p class="lead lead-in" style='color:#fff'>DA PUBBLICARE</p>
            </div> 
        </div>
        @endif
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Estratto:</p>
            </div> 
            <div class="form-group col-10">
                <p class="lead">{{ $news->excerpt }}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Testo:</p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $news->body }}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Titolo anteprima: </p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $news->preview_title }}</p>
            </div>
            <div class="form-group col-2">
                <p class="lead lead-in">Sottotitolo anteprima: </p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $news->preview_subtitle }}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Pubblicazione il </p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ date("d-m-Y", strtotime($news->date))}}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-12 d-flex justify-content-center">
                <div class="preview-container">
                    <img id="previewHolder" width="250px" height="170px" src='{{ $news->image_path }}'/>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection 
