@extends ('layouts.db')

@section('main_content_page')
<script src="/js/forms_handling.js" type="module"></script>
  <div class='row'>
    <div class='col-12'>
      <h3 class='section_title'>Nuovo appuntamento</h3>
      <hr class='styled-hr'>
      <form method='POST' action='{{ route("meeting.store") }}'>
        @csrf
        <input name="customer_id" id="cust-id" type="hidden">
        <div class="row">
          <div class="form-group col-12">
            <label class='db_form_label' for="cust-select">Cliente</label>
            <select class="selectpicker show-tick form-control" id="cust-select" data-size="5" data-live-search="true">
              <option>Seleziona cliente o aggiungilo manualmente</option>
              <option data-divider="true"></option>
              @php
                $selected_cid = $errors->any() ? old('customer_id') : '';
              @endphp
              <optgroup label="Miei clienti">
                @foreach ($personal_customers as $customer)
                  <option value='{{ $customer->id }}' {{$selected_cid == $customer->id ? 'selected' : ''}}>{{ $customer->title }} {{ $customer->first_name }} {{ $customer->last_name }}</option>
                @endforeach
              </optgroup>
              <optgroup label="Altri clienti">
                  @foreach ($customers as $customer)
                    <option value='{{ $customer->id }}' {{$selected_cid == $customer->id ? 'selected' : ''}}>{{ $customer->title }} {{ $customer->first_name }} {{ $customer->last_name }}</option>
                  @endforeach
              </optgroup>
            </select>
          </div>
        </div>
        <div class='row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="cust_name">Nome</label>
            <input type="text" class="form-control {{ $errors->has('cust_name') ? 'form-error' : ''}}" name="cust_name" id="cust-name" value="{{ old('cust_name') }}" placeholder="Nome">
            @error('cust_name')
              <p class="error-input">{{ $errors->first('cust_name')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="cust_surname">Cognome</label>
            <input type="text" class="form-control {{ $errors->has('cust_surname') ? 'form-error' : ''}}" name="cust_surname" id="cust-surname" value="{{ old('cust_surname') }}" placeholder="Cognome">
            @error('cust_surname')
              <p class="error-input">{{ $errors->first('cust_surname')}}</p>
            @enderror
          </div>
        </div>
        <div class='row'>
          <div class="form-group col-12 col-md-9">
            <label class='db_form_label' for="meet_address">Indirizzo appuntamento</label>
            <input type="text" class="form-control {{ $errors->has('meet_address') ? 'form-error' : ''}}" name="meet_address" id="meet-place" value="{{ old('meet_address') }}" placeholder="Sede appuntamento">
            @error('meet_address')
              <p class="error-input">{{ $errors->first('meet_address')}}</p>
            @enderror
          </div>
          <div class="form-check col-12 col-md-3">
          <div class="checkbox-container">
            <p class='db_form_label input-title'>Remoto/Web?</p>
            <label class="checkbox-label" for="remote">
              <input type="checkbox" class="{{ $errors->has('remote') ? 'form-error' : ''}}" name="remote" id="remote" {{ old('remote') ? 'checked' : ''}}>
              <span class="checkbox-custom rectangular"></span>
            </label>
          </div>
          @error('remote')
            <p class="error-input">{{ $errors->first('remote')}}</p>
          @enderror
        </div>
        </div>
        <div class='row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="meet_date">Data</label>
            <input type="date" class="form-control {{ $errors->has('meet_date') ? 'form-error' : ''}}" name="meet_date" id="meet-date" value="{{ old('meet_date') }}" placeholder="Data">
            @error('meet_date')
              <p class="error-input">{{ $errors->first('meet_date')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="meet_time">Ora</label>
            <input type="time" class="form-control {{ $errors->has('meet_time') ? 'form-error' : ''}}" name="meet_time" id="meet-time" value="{{ old('meet_time') }}" placeholder="Ora">
            @error('meet_time')
              <p class="error-input">{{ $errors->first('meet_time')}}</p>
            @enderror
          </div>
        </div>
        <div class='row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="notes">Note/dettagli</label>
            <input type="text" class="form-control {{ $errors->has('notes') ? 'form-error' : ''}}" name="notes" id="meet-notes" value="{{ old('notes') }}" placeholder="Note">
            @error('notes')
              <p class="error-input">{{ $errors->first('notes')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="user-select">Agente</label>
            <select class="selectpicker show-tick form-control {{ $errors->has('user_id') ? 'form-error' : ''}}" data-size="5" data-live-search="true" id="user-id" name="user_id">
              @php
                $selected_id = $errors->any() ? old('user_id') : Auth::user()->id;
              @endphp
              @foreach ($users as $user)
                <option value='{{ $user->id }}' {{$selected_id == $user->id ? 'selected' : ''}}>{{ $user->profile->first_name }} {{ $user->profile->last_name }}</option>
              @endforeach
            </select>
            @error('user_id')
              <p class="error-input">{{ $errors->first('user_id')}}</p>
            @enderror
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva</button>
      </form>
    </div>
  </div>
@endsection
