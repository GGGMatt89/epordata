@extends ('layouts.db')

@section('main_content_page')
  <div class='row'>
    <div class='col-12'>
      <h3 class='section_title'>Nuovo cliente</h3>
      <hr class='styled-hr'>
      <form method='POST' action='{{ route("customer.store") }}'>
        @csrf
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="cus_code">Codice cliente</label>
            <input type="text" class="form-control {{ $errors->has('cus_code') ? 'form-error' : ''}}" name="cus_code" id="cus_code" value="{{ old('cus_code') }}" placeholder="Codice cliente">
            @error('cust_code')
              <p class="error-input">{{ $errors->first('cust_code')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="univ_code">Codice univoco</label>
            <input type="text" class="form-control {{ $errors->has('univ_code') ? 'form-error' : ''}}" name="univ_code" id="univ_code" value="{{ old('univ_code') }}" placeholder="Codice univoco">
            @error('univ_code')
              <p class="error-input">{{ $errors->first('univ_code')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="first_name">Nome</label>
            <input type="text" class="form-control {{ $errors->has('first_name') ? 'form-error' : ''}}" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Nome">
            @error('first_name')
              <p class="error-input">{{ $errors->first('first_name')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="last_name">Cognome</label>
            <input type="text" class="form-control {{ $errors->has('last_name') ? 'form-error' : ''}}" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Cognome">
            @error('last_name')
              <p class="error-input">{{ $errors->first('last_name')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="title">Titolo</label>
            <input type="text" class="form-control {{ $errors->has('title') ? 'form-error' : ''}}" name="title" id="title" value="{{ old('title') }}" placeholder="Titolo">
            @error('title')
              <p class="error-input">{{ $errors->first('title')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="bus_name">Ragione sociale</label>
            <input type="text" class="form-control {{ $errors->has('bus_name') ? 'form-error' : ''}}" name="bus_name" id="bus_name" value="{{ old('bus_name') }}" placeholder="Ragione sociale">
            @error('bus_name')
              <p class="error-input">{{ $errors->first('bus_name')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="tax_code">Codice fiscale</label>
            <input type="text" class="form-control {{ $errors->has('tax_code') ? 'form-error' : ''}}" name="tax_code" id="tax_code" value="{{ old('tax_code') }}" placeholder="Codice fiscale">
            @error('tax_code')
              <p class="error-input">{{ $errors->first('tax_code')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="vat_num">Partita IVA</label>
            <input type="text" class="form-control {{ $errors->has('vat_num') ? 'form-error' : ''}}" name="vat_num" id="vat_num" value="{{ old('vat_num') }}" placeholder="Partita IVA">
            @error('vat_num')
              <p class="error-input">{{ $errors->first('vat_num')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="email">Email</label>
            <input type="text" class="form-control {{ $errors->has('email') ? 'form-error' : ''}}" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
            @error('email')
              <p class="error-input">{{ $errors->first('email')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="pec">PEC</label>
            <input type="text" class="form-control {{ $errors->has('pec') ? 'form-error' : ''}}" name="pec" id="pec" value="{{ old('pec') }}" placeholder="PEC">
            @error('pec')
              <p class="error-input">{{ $errors->first('pec')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="office_phone"><i class="fas fa-phone"></i> ufficio</label>
            <input type="text" class="form-control {{ $errors->has('office_phone') ? 'form-error' : ''}}" name="office_phone" id="office_phone" value="{{ old('office_phone') }}" placeholder="Telefono ufficio">
            @error('office_phone')
              <p class="error-input">{{ $errors->first('office_phone')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="mobile_phone"><i class="fas fa-mobile-alt"></i> cellulare</label>
            <input type="text" class="form-control {{ $errors->has('mobile_phone') ? 'form-error' : ''}}" name="mobile_phone" id="mobile_phone" value="{{ old('mobile_phone') }}" placeholder="Telefono cellulare">
            @error('mobile_phone')
              <p class="error-input">{{ $errors->first('mobile_phone')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-8">
            <label class='db_form_label' for="address">Indirizzo</label>
            <input type="text" class="form-control {{ $errors->has('address') ? 'form-error' : ''}}" name="address" id="address" value="{{ old('address') }}" placeholder="Indirizzo">
            @error('address')
              <p class="error-input">{{ $errors->first('address')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-4">
            <label class='db_form_label' for="post_code">Codice postale</label>
            <input type="text" class="form-control {{ $errors->has('post_code') ? 'form-error' : ''}}" name="post_code" id="post_code" value="{{ old('post_code') }}" placeholder="Codice postale">
            @error('post_code')
              <p class="error-input">{{ $errors->first('post_code')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="city">Città</label>
            <input type="text" class="form-control {{ $errors->has('city') ? 'form-error' : ''}}" name="city" id="city" value="{{ old('city') }}" placeholder="Città">
            @error('city')
              <p class="error-input">{{ $errors->first('city')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="region">Provincia</label>
            <input type="text" class="form-control {{ $errors->has('region') ? 'form-error' : ''}}" name="region" id="region" value="{{ old('region') }}" placeholder="Regione">
            @error('region')
              <p class="error-input">{{ $errors->first('region')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="category">Categoria</label>
            <select class="selectpicker show-tick form-control {{ $errors->has('category') ? 'form-error' : ''}}" data-size="5" id="category" name="category" value="{{ old('category') }}">
              <option value=" " selected>Seleziona categoria cliente</option>
              <option data-divider="true"></option>
              @php
                $selected_cat = $errors->any() ? old('category') : ' ';
              @endphp
              @foreach($categories as $category)
                <option value={{$category}} {{$selected_cat == $category ? 'selected' : ''}}>{{$category}}</option>
              @endforeach
            </select>
            @error('category')
              <p class="error-input">{{ $errors->first('category')}}</p>
            @enderror
          </div>
          <div class="form-group col-12 col-md-6">
            <label class='db_form_label' for="handler">Curatore</label>
            <select class="selectpicker show-tick form-control {{ $errors->has('handler') ? 'form-error' : ''}}" data-size="5" id="handler" name="handler" value="{{ old('handler') }}">
              <option value=" " selected>Seleziona curatore cliente</option>
              <option data-divider="true"></option>
              @php
                $selected_hand = $errors->any() ? old('handler') : ' ';
              @endphp
              @foreach($handlers as $handler)
                <option value={{$handler}} {{$selected_hand == $handler ? 'selected' : ''}}>{{$handler}}</option>
              @endforeach
            </select>
            @error('handler')
              <p class="error-input">{{ $errors->first('handler')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12">
            <label class='db_form_label' for="rating">Rating</label>
            <select class="selectpicker show-tick form-control {{ $errors->has('rating') ? 'form-error' : ''}}" data-size="5" id="rating" name="rating" value="{{ old('rating') }}">
              <option value=" " selected>Seleziona rating cliente</option>
              <option data-divider="true"></option>
              @php
                $selected_rat = $errors->any() ? old('rating') : ' ';
              @endphp
              @foreach($ratings as $rating)
                <option value={{$rating}} {{$selected_rat == $rating ? 'selected' : ''}}>{{$rating}}</option>
              @endforeach
            </select>
            @error('rating')
              <p class="error-input">{{ $errors->first('rating')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12">
            <label class='db_form_label' for="profile_id">Agente di riferimento</label>
            <select class="selectpicker show-tick  form-control {{ $errors->has('profile_id') ? 'form-error' : ''}}" data-size="5" name="profile_id" id="profile_id" value="{{ old('profile_id') }}" data-live-search="true">
              <option value=' ' selected>Selezione agente di riferimento</option>
              <option data-divider="true"></option>
              @php
                $selected_prof = $errors->any() ? old('profile_id') : ' ';
              @endphp
              @foreach($profiles as $profile)
                <option value='{{$profile->id}}' {{$selected_prof == $profile->id ? 'selected' : ''}}>{{$profile -> first_name}} {{$profile -> last_name}}</option>
              @endforeach
            </select>
            @error('profile_id')
              <p class="error-input">{{ $errors->first('profile_id')}}</p>
            @enderror
          </div>
        </div>
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingRef">
              <h5 class="mb-0">
              <button type='button' class="btn btn-link" data-toggle="collapse" data-target="#collapseRef" aria-expanded="true" aria-controls="collapseRef">
                <i class="fas fa-chevron-down"></i>  Referente cliente (opzionale)
              </button>
              </h5>
            </div>
            <div id="collapseRef" class="collapse" aria-labelledby="headingRef" data-parent="#accordion">
                <div class="card-body">
                  <div class='form-row'>
                    <div class="form-group col-12 col-md-6">
                      <label class='db_form_label' for="ref_name">Nome</label>
                      <input type="text" class="form-control {{ $errors->has('ref_name') ? 'form-error' : ''}}" name="ref_name" id="ref_name" value="{{ old('ref_name') }}" placeholder="Nome">
                      @error('ref_name')
                        <p class="error-input">{{ $errors->first('ref_name')}}</p>
                      @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label class='db_form_label' for="ref_surname">Cognome</label>
                      <input type="text" class="form-control {{ $errors->has('ref_surname') ? 'form-error' : ''}}" name="ref_surname" id="ref_surname" value="{{ old('ref_surname') }}" placeholder="Cognome">
                      @error('ref_surname')
                        <p class="error-input">{{ $errors->first('ref_surname')}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class='form-row'>
                    <div class="form-group col-12">
                      <label class='db_form_label' for="ref_title">Ruolo</label>
                      <input type="text" class="form-control {{ $errors->has('ref_title') ? 'form-error' : ''}}" name="ref_title" id="ref_title" value="{{ old('ref_title') }}" placeholder="Ruolo">
                      @error('ref_title')
                        <p class="error-input">{{ $errors->first('ref_title')}}</p>
                      @enderror
                    </div>
                    <div class="form-group col-5">
                      <label class='db_form_label' for="ref_email"><i class="far fa-envelope"></i> Email</label>
                      <input type="text" class="form-control {{ $errors->has('ref_email') ? 'form-error' : ''}}" name="ref_email" id="ref_email" value="{{ old('ref_email') }}" placeholder="Email">
                      @error('ref_email')
                        <p class="error-input">{{ $errors->first('ref_email')}}</p>
                      @enderror
                    </div>
                  </div>
                  <div class='form-row'>
                    <div class="form-group col-12 col-md-6">
                      <label class='db_form_label' for="ref_phone"><i class="fas fa-phone"></i> Ufficio / <i class="fas fa-mobile-alt"></i> Cellulare</label>
                      <input type="text" class="form-control {{ $errors->has('ref_phone') ? 'form-error' : ''}}" name="ref_phone" id="ref_phone" value="{{ old('ref_phone') }}" placeholder="Telefono">
                      @error('ref_phone')
                        <p class="error-input">{{ $errors->first('ref_phone')}}</p>
                      @enderror
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva</button>
    </form>
  </div>
</div>
<script>
    $(document).ready(function () {
    $("#collapseRef").on("hide.bs.collapse", function () {
        $(".btn-link").html('<i class="fas fa-chevron-down"></i>  Referente cliente (opzionale)');
    });
    $("#collapseRef").on("show.bs.collapse", function () {
        $(".btn-link").html('<i class="fas fa-chevron-up"></i>  Referente cliente (opzionale)');
    });
});
</script>
@endsection
