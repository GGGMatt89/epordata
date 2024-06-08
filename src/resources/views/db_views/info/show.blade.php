@extends ('layouts.db')

@section ('main_content_page')
    <div class="jumbotron" style="width: 80%; margin: auto">
      <div class="container">
        <div class='row'>
            <div class='col-12 col-lg-10'>
                <h3 class="section_title">{{$info->title}} </h3>
            </div>
            <div class='col-3 col-lg-1 mx-auto'>
               <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('info.edit', $info->id) }}"><i class="far fa-edit"></i></a> 
            </div>    
            <div class='col-3 col-lg-1 mx-auto'>
                <form class='delete_form' id='{{$info->id}}_delete_form' action="{{ route('info.delete', $info->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$info->id}})'><i class="far fa-trash-alt"></i></button>
                </form>
            </div>    
        </div>
        <div class='row'>
            <hr class='show-sep'>  
        </div>
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Estratto:</p>
            </div> 
            <div class="form-group col-10">
                <p class="lead">{{ $info->excerpt }}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Testo:</p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $info->body }}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-2">
                <p class="lead lead-in">Titolo anteprima: </p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $info->preview_title }}</p>
            </div>
            <div class="form-group col-2">
                <p class="lead lead-in">Sottotitolo anteprima: </p>
            </div>
            <div class="form-group col-10">
                <p class="lead">{{ $info->preview_subtitle }}</p>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-12 d-flex justify-content-center">
                <div class="preview-container">
                    <img id="previewHolder" width="250px" height="170px" src='{{ $info->image_path }}'/>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection 
