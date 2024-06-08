@extends ('layouts.db')

@section('main_content_page')
  <div class='row'>
    <div class='col-12'>
      <h3 class='section_title'>Modifica fornitore</h3>
      <hr class='styled-hr'>
      <form method='POST' action='{{ route("provider.update", $provider->id) }}'>
        @csrf
        @method('PUT')
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="code">Codice fornitore</label>
            <input type="text" class="form-control {{ $errors->has('code') ? 'form-error' : ''}}" name="code" id="code" value="{{ $errors->any() ? old('code') : $provider->code }}" placeholder="Codice fornitore">
            @error('code')
              <p class="error-input">{{ $errors->first('code')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="univ_code">Codice univoco</label>
            <input type="text" class="form-control {{ $errors->has('univ_code') ? 'form-error' : ''}}" name="univ_code" id="univ_code" value="{{ $errors->any() ? old('univ_code') : $provider->univ_code }}" placeholder="Codice univoco">
            @error('univ_code')
              <p class="error-input">{{ $errors->first('univ_code')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12">
            <label class='db_form_label' for="bus_name">Nome/Ragione sociale</label>
            <input type="text" class="form-control {{ $errors->has('bus_name') ? 'form-error' : ''}}" name="bus_name" id="bus_name" value="{{ $errors->any() ? old('bus_name') : $provider->bus_name }}" placeholder="Ragione sociale">
            @error('bus_name')
              <p class="error-input">{{ $errors->first('bus_name')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="tax_code">Codice fiscale</label>
            <input type="text" class="form-control {{ $errors->has('tax_code') ? 'form-error' : ''}}" name="tax_code" id="tax_code" value="{{ $errors->any() ? old('tax_code') : $provider->tax_code }}" placeholder="Codice fiscale">
            @error('tax_code')
              <p class="error-input">{{ $errors->first('tax_code')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="vat_num">Partita IVA</label>
            <input type="text" class="form-control {{ $errors->has('vat_num') ? 'form-error' : ''}}" name="vat_num" id="vat_num" value="{{ $errors->any() ? old('vat_num') : $provider->vat_num }}" placeholder="Partita IVA">
            @error('vat_num')
              <p class="error-input">{{ $errors->first('vat_num')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="email">Email</label>
            <input type="text" class="form-control {{ $errors->has('email') ? 'form-error' : ''}}" name="email" id="email" value="{{ $errors->any() ? old('email') : $provider->email }}" placeholder="Email">
            @error('email')
              <p class="error-input">{{ $errors->first('email')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="pec">PEC</label>
            <input type="text" class="form-control {{ $errors->has('pec') ? 'form-error' : ''}}" name="pec" id="pec" value="{{ $errors->any() ? old('pec') : $provider->pec }}" placeholder="PEC">
            @error('pec')
              <p class="error-input">{{ $errors->first('pec')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="office_phone"><i class="fas fa-phone"></i> ufficio</label>
            <input type="text" class="form-control {{ $errors->has('office_phone') ? 'form-error' : ''}}" name="office_phone" id="office_phone" value="{{ $errors->any() ? old('office_phone') : $provider->office_phone }}" placeholder="Telefono ufficio">
            @error('office_phone')
              <p class="error-input">{{ $errors->first('office_phone')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="mobile_phone"><i class="fas fa-mobile-alt"></i> cellulare</label>
            <input type="text" class="form-control {{ $errors->has('mobile_phone') ? 'form-error' : ''}}" name="mobile_phone" id="mobile_phone" value="{{ $errors->any() ? old('mobile_phone') : $provider->mobile_phone }}" placeholder="Telefono cellulare">
            @error('mobile_phone')
              <p class="error-input">{{ $errors->first('mobile_phone')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-8">
            <label class='db_form_label' for="address">Indirizzo</label>
            <input type="text" class="form-control {{ $errors->has('address') ? 'form-error' : ''}}" name="address" id="address" value="{{ $errors->any() ? old('address') : $provider->address }}" placeholder="Indirizzo">
            @error('address')
              <p class="error-input">{{ $errors->first('address')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-4">
            <label class='db_form_label' for="post_code">Codice postale</label>
            <input type="text" class="form-control {{ $errors->has('post_code') ? 'form-error' : ''}}" name="post_code" id="post_code" value="{{ $errors->any() ? old('post_code') : $provider->post_code }}" placeholder="Codice postale">
            @error('post_code')
              <p class="error-input">{{ $errors->first('post_code')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="city">Città</label>
            <input type="text" class="form-control {{ $errors->has('city') ? 'form-error' : ''}}" name="city" id="city" value="{{ $errors->any() ? old('city') : $provider->city }}" placeholder="Città">
            @error('city')
              <p class="error-input">{{ $errors->first('city')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="region">Provincia</label>
            <input type="text" class="form-control {{ $errors->has('region') ? 'form-error' : ''}}" name="region" id="region" value="{{ $errors->any() ? old('region') : $provider->region }}" placeholder="Regione">
            @error('region')
              <p class="error-input">{{ $errors->first('region')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12">
            <label class='db_form_label' for="category">Categoria</label>
            <select class="selectpicker show-tick form-control {{ $errors->has('category') ? 'form-error' : ''}}" data-size="5" id="category" name="category">
              <option value=" ">Seleziona categoria cliente</option>
              <option data-divider="true"></option>
              @php
               $selected_cat = $errors->any() ? old('category') : $provider->category;
              @endphp
              @foreach($categories as $category)
                <option value='{{$category}}' {{$selected_cat == $category ? 'selected' : ''}}>{{$category}}</option>
              @endforeach
            </select>
            @error('category')
              <p class="error-input">{{ $errors->first('category')}}</p>
            @enderror
          </div>
        </div>
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingRef">
              <h5 class="mb-0">
              <button type='button' class="btn btn-link" data-toggle="collapse" data-target="#collapseRef" aria-expanded="true" aria-controls="collapseRef">
                <i class="fas fa-chevron-down"></i> Referente fornitore (opzionale)
              </button>
              </h5>
            </div>
            <div id="collapseRef" class="collapse" aria-labelledby="headingRef" data-parent="#accordion">
                <div class="card-body">
                  <div class='form-row'>
                    <div class="form-group col-12 col-md-6">
                      <label class='db_form_label' for="ref_name">Nome</label>
                      <input type="text" class="form-control {{ $errors->has('ref_name') ? 'form-error' : ''}}" name="ref_name" id="ref_name" value="{{ $errors->any() ? old('ref_name') : $provider->ref_name }}" placeholder="Nome">
                      @error('ref_name')
                        <p class="error-input">{{ $errors->first('ref_name')}}</p>
                      @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label class='db_form_label' for="ref_surname">Cognome</label>
                      <input type="text" class="form-control {{ $errors->has('ref_surname') ? 'form-error' : ''}}" name="ref_surname" id="ref_surname" value="{{ $errors->any() ? old('ref_surname') : $provider->ref_surname }}" placeholder="Cognome">
                      @error('ref_surname')
                        <p class="error-input">{{ $errors->first('ref_surname')}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class='form-row'>
                    <div class="form-group col-12">
                      <label class='db_form_label' for="ref_title">Ruolo</label>
                      <input type="text" class="form-control {{ $errors->has('ref_title') ? 'form-error' : ''}}" name="ref_title" id="ref_title" value="{{ $errors->any() ? old('ref_title') : $provider->ref_title }}" placeholder="Ruolo">
                      @error('ref_title')
                        <p class="error-input">{{ $errors->first('ref_title')}}</p>
                      @enderror
                    </div>
                    <div class="form-group col-5">
                      <label class='db_form_label' for="ref_email"><i class="far fa-envelope"></i> Email</label>
                      <input type="text" class="form-control {{ $errors->has('ref_email') ? 'form-error' : ''}}" name="ref_email" id="ref_email" value="{{ $errors->any() ? old('ref_email') : $provider->ref_email }}" placeholder="Email">
                      @error('ref_email')
                        <p class="error-input">{{ $errors->first('ref_email')}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class='form-row'>
                    <div class="form-group col-12 col-md-6">
                      <label class='db_form_label' for="ref_phone"><i class="fas fa-phone"></i> Ufficio / <i class="fas fa-mobile-alt"></i> Cellulare</label>
                      <input type="text" class="form-control {{ $errors->has('ref_phone') ? 'form-error' : ''}}" name="ref_phone" id="ref_phone" value="{{ $errors->any() ? old('ref_phone') : $provider->ref_phone }}" placeholder="Telefono">
                      @error('ref_phone')
                        <p class="error-input">{{ $errors->first('ref_phone')}}</p>
                      @enderror
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva modifiche</button>
    </form>
  </div>
</div>
  <script>
    $(document).ready(function () {
    $("#collapseRef").on("hide.bs.collapse", function () {
        $(".btn-link").html('<i class="fas fa-chevron-down"></i>  Referente fornitore (opzionale)');
    });
    $("#collapseRef").on("show.bs.collapse", function () {
        $(".btn-link").html('<i class="fas fa-chevron-up"></i>  Referente fornitore (opzionale)');
    });
  });
</script>
@endsection
