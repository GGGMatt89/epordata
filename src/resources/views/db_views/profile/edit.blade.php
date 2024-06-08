@extends ('layouts.db')
@section('main_content_page')
  <div class='row'>
    <div class='col-12'>
      <h3 class='section_title'>Modifica profilo</h3>
      <hr class='styled-hr'>
      <form method='POST' action='{{ route("profile.update", $profile->id) }}' enctype='multipart/form-data'>
        @csrf
        @method('PUT')
        <input name="user_id" id="user_id" type="hidden" value={{ $profile->user_id }}>
        <div class='form-row'>
          <div class="form-group col-6">
            <label class='db_form_label' for="first_name">Nome</label>
            <input type="text" class="form-control {{ $errors->has('first_name') ? 'form-error' : ''}}" name="first_name" id="first_name" placeholder="Nome" value={{ $errors->any() ? old('first_name') : $profile->first_name }}>
            @error('first_name')
              <p class="error-input">{{ $errors->first('first_name')}}</p>
            @enderror
          </div>
          <div class="form-group col-6">
            <label class='db_form_label' for="last_name">Cognome</label>
            <input type="text" class="form-control {{ $errors->has('last_name') ? 'form-error' : ''}}" name="last_name" id="last_name" placeholder="Cognome" value="{{ $errors->any() ? old('last_name') : $profile->last_name }}">
            @error('last_name')
              <p class="error-input">{{ $errors->first('last_name')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-6">
            <label class='db_form_label' for="birth_date">Data di nascita</label>
            <input type="date" class="form-control {{ $errors->has('birth_date') ? 'form-error' : ''}}" name="birth_date" id="birth_date" placeholder="Data di nascita" value={{ $errors->any() ? old('birth_date') : $profile->birth_date }}>
            @error('birth_date')
              <p class="error-input">{{ $errors->first('birth_date')}}</p>
            @enderror
          </div>
          <div class="form-group col-6">
            <label class='db_form_label' for="tax_code">Codice fiscale</label>
            <input type="text" class="form-control {{ $errors->has('tax_code') ? 'form-error' : ''}}" name="tax_code" id="tax_code" placeholder="Codice fiscale" value={{ $errors->any() ? old('tax_code') : $profile->tax_code }}>
            @error('tax_code')
              <p class="error-input">{{ $errors->first('tax_code')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-6">
            <label class='db_form_label' for="res_address">Indirizzo</label>
            <input type="text" class="form-control {{ $errors->has('res_address') ? 'form-error' : ''}}" name="res_address" id="res_address" placeholder="Indirizzo" value="{{ $errors->any() ? old('res_address') : $profile->res_address }}">
            @error('res_address')
              <p class="error-input">{{ $errors->first('res_address')}}</p>
            @enderror
          </div>
          <div class="form-group col-3">
            <label class='db_form_label' for="post_code">Codice postale</label>
            <input type="text" class="form-control {{ $errors->has('post_code') ? 'form-error' : ''}}" name="post_code" id="post_code" placeholder="Codice postale" value={{ $errors->any() ? old('post_code') : $profile->post_code }}>
            @error('post_code')
              <p class="error-input">{{ $errors->first('post_code')}}</p>
            @enderror
          </div>
          <div class="form-group col-3">
            <label class='db_form_label' for="res_city">Città</label>
            <input type="text" class="form-control {{ $errors->has('res_city') ? 'form-error' : ''}}" name="res_city" id="res_city" placeholder="Città" value="{{ $errors->any() ? old('res_city') : $profile->res_city }}">
            @error('res_city')
              <p class="error-input">{{ $errors->first('res_city')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-8">
            <label class='db_form_label' for="mobile_phone">Cellulare</label>
            <input type="text" class="form-control {{ $errors->has('mobile_phone') ? 'form-error' : ''}}" name="mobile_phone" id="mobile_phone" placeholder="Cellulare" value="{{ $errors->any() ? old('mobile_phone') : $profile->mobile_phone  }}">
            @error('mobile_phone')
              <p class="error-input">{{ $errors->first('mobile_phone')}}</p>
            @enderror
          </div>
          <div class="form-group col-4">
            <label class='db_form_label' for="area">Area</label>
            <input type="text" class="form-control {{ $errors->has('area') ? 'form-error' : ''}}" name="area" id="area" placeholder="Area di competenza" value="{{ $errors->any() ? old('area') : $profile->area }}">
            @error('area')
              <p class="error-input">{{ $errors->first('area')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-9">
            <label class='db_form_label input-file-label' for="image_path"><i class="fas fa-file-upload"></i> Carica immagine</label>
            <input type="file" class="input-file form-control" @error('image') is-invalid @enderror name="image" id="image_path">
              @error('image')
                <p class="error-input">{{ $errors->first('image')}}</p>
              @enderror
          </div>
          <div class="col-3 d-flex justify-content-center">
            <div class="team-member">
              <img id="previewHolder" class="mx-auto rounded-circle" src={{ $profile->image }} alt="{{$profile->first_name}} {{$profile->last_name}}"/>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva modifiche</button>
      </form>
    </div>
  </div>
<script src="/js/image_preview.js"></script>
@endsection
