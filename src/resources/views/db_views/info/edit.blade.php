@extends ('layouts.db')

@section('main_content_page')
  <div class='row'>
    <div class='col-12'>  
      <h3 class='section_title'>Modifica info</h3>
      <hr class='styled-hr'> 
      <form method='POST' action='{{ route("info.update", $info->id) }}' enctype='multipart/form-data'>
      @csrf
      @method('PUT')
      <div class='form-row'>
        <div class="form-group col-12 col-md-6">
          <label class='db_form_label' for="title">Titolo</label>
          <input type="text" class="form-control {{ $errors->has('title') ? 'form-error' : ''}}" name="title" id="title" value="{{$errors->any() ? old('title') : $info->title}}" placeholder="Titolo">
          @error('title')
            <p class="error-input">{{ $errors->first('title')}}</p>
          @enderror
        </div>
        <div class="form-group col-12 col-md-6">
          <label class='db_form_label' for="excerpt">Estratto</label>
          <input type="text" class="form-control {{ $errors->has('excerpt') ? 'form-error' : ''}}" name="excerpt" id="excerpt" value="{{ $errors->any() ? old('excerpt') : $info->excerpt }}" placeholder="Estratto">
          @error('excerpt')
            <p class="error-input">{{ $errors->first('excerpt')}}</p>
          @enderror
        </div>
      </div> 
      <div class='form-row'> 
        <div class="form-group col-12">
          <label class='db_form_label' for="body">Testo</label>
          <textarea class="form-control {{ $errors->has('body') ? 'form-error' : ''}}" name="body" id="body" placeholder="Testo">{{ $errors->any() ? old('body') : $info->body }}</textarea>
          @error('body')
            <p class="error-input">{{ $errors->first('body')}}</p>
          @enderror
        </div>
      </div>
      <div class='form-row'> 
        <div class="form-group col-12 col-lg-6">
          <label class='db_form_label' for="preview_title">Titolo anteprima</label>
          <input type="text" class="form-control {{ $errors->has('preview_title') ? 'form-error' : ''}}" name="preview_title" id="preview_title" value="{{ $errors->any() ? old('preview_title') : $info->preview_title }}" placeholder="Titolo anteprima">
          @error('preview_title')
            <p class="error-input">{{ $errors->first('preview_title')}}</p>
          @enderror
        </div>
        <div class="form-group col-12 col-lg-6">
          <label class='db_form_label' for="preview_subtitle">Sottotitolo anteprima</label>
          <input type="text" class="form-control {{ $errors->has('preview_subtitle') ? 'form-error' : ''}}" name="preview_subtitle" id="preview_subtitle" value="{{ $errors->any() ? old('preview_subtitle') : $info->preview_subtitle }}" placeholder="Sottotitolo anteprima">
          @error('preview_subtitle')
            <p class="error-input">{{ $errors->first('preview_subtitle')}}</p>
          @enderror
        </div>
      </div>
      <div class='form-row'> 
        <div class="form-group col-6 col-md-3">
          <label class='db_form_label input-file-label' for="image_path"><i class="fas fa-file-upload"></i> Carica immagine</label>
          <input type="file" class="input-file form-control" @error('image_path') is-invalid @enderror name="image_path" id="image_path" value='{{ $errors->any() ? old('image_path') : $info->image_path }}'>
          @error('image_path')
              <span role='alert' class='invalid-feedback'>
                  <strong>{{ $message }}</strong>
              </span>    
          @enderror
        </div>
        <div class="col-6 col-md-3 d-flex justify-content-center">
          <div class="preview-container">
            <img id="previewHolder" src={{ $info->image_path <> ' ' ? $info->image_path : '/img/info/default.png' }} width="250px" height="170px"/>
          </div>
        </div>  
      </div>
      <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva modifiche</button>
      </form>
    </div>
  </div>
  <script src="/js/image_preview.js"></script>
@endsection 
