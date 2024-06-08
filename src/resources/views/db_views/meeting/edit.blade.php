@extends ('layouts.db')

@section('main_content_page')
<script src="/js/forms_handling.js"></script>
  <div class='row'>
    <div class='col-12'>
      <h3 class='section_title'>Modifica appuntamento</h3>
      <hr class='styled-hr'>
      <form method='POST' action='{{ route("meeting.update", $meeting->id) }}'>
        @csrf
        @method('PUT')
        <input name="cust_id" id="cust-id" type="hidden" value={{ $meeting->cust_id }}>
        <div class="form-row">
          <div class="form-group col-12">
            <label class='db_form_label' for="cust-select">Cliente</label>
            <select class="selectpicker show-tick form-control" data-size="5" data-live-search="true" id="cust-select">
              <option>Seleziona cliente o modificalo manualmente</option>
              <option data-divider="true"></option>
              @foreach ($customers as $customer)
                <option value='{{ $customer->id }}'>{{ $customer->title }} {{ $customer->first_name }} {{ $customer->last_name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="cust_name">Nome</label>
            <input type="text" class="form-control {{ $errors->has('cust_name') ? 'form-error' : ''}}" name="cust_name" id="cust-name" placeholder="Nome" value={{ $errors->any() ? old('cust_name') : $meeting->cust_name }}>
            @error('cust_name')
              <p class="error-input">{{ $errors->first('cust_name')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="cust_surname">Cognome</label>
            <input type="text" class="form-control {{ $errors->has('cust_surname') ? 'form-error' : ''}}" name="cust_surname" id="cust-surname" placeholder="Cognome" value={{ $errors->any() ? old('cust_surname') : $meeting->cust_surname }}>
            @error('cust_surname')
              <p class="error-input">{{ $errors->first('cust_surname')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12 col-md-9">
            <label class='db_form_label' for="meet_address">Indirizzo appuntamento</label>
            <input type="text" class="form-control {{ $errors->has('meet_address') ? 'form-error' : ''}}" name="meet_address" id="meet-place" placeholder="Indirizzo appuntamento" value="{{ $errors->any() ? old('meet_address') : $meeting->meet_address }}">
            @error('meet_address')
              <p class="error-input">{{ $errors->first('meet_address')}}</p>
            @enderror
          </div>
          <div class="form-check col-12 col-md-3">
          <div class="checkbox-container">
            <p class='db_form_label input-title'>Remoto/Web?</p>
            <label class="checkbox-label" for="remote">
              <input type="checkbox" class="{{ $errors->has('remote') ? 'form-error' : ''}}" name="remote" id="remote" {{ (($errors->any() && old('remote')) || $meeting->remote) ? 'checked' : '' }}>
              <span class="checkbox-custom rectangular"></span>
            </label>
          </div>
          @error('remote')
            <p class="error-input">{{ $errors->first('remote')}}</p>
          @enderror
        </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="meet_date">Data</label>
            <input type="date" class="form-control {{ $errors->has('meet_date') ? 'form-error' : ''}}" name="meet_date" id="meet-date" placeholder="Data"
                value={{ $errors->any() ? old('meet_date') : date("Y-m-d", strtotime($meeting->scheduled_at))}}>
            @error('meet_date')
              <p class="error-input">{{ $errors->first('meet_date')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="meet_time">Ora</label>
            <input type="time" class="form-control {{ $errors->has('meet_time') ? 'form-error' : ''}}" name="meet_time" id="meet-time" placeholder="Ora"
                value={{ $errors->any() ? old('meet_time') : date("H:i", strtotime($meeting->scheduled_at))}}>
            @error('meet_time')
              <p class="error-input">{{ $errors->first('meet_time')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="notes">Note/dettagli</label>
            <input type="text" class="form-control {{ $errors->has('notes') ? 'form-error' : ''}}" name="notes" id="meet-notes" placeholder="Note" value="{{ $errors->any() ? old('notes') : $meeting->notes }}">
            @error('notes')
              <p class="error-input">{{ $errors->first('notes')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="user-select">Agente</label>
            <select class="selectpicker show-tick form-control {{ $errors->has('user_id') ? 'form-error' : ''}}" data-size="5" data-live-search="true" id="user-id" name="user_id">
              @php
                $selected_id = $errors->any() ? old('user_id') : $meeting->user_id;
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
            <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva modifiche</button>
          </form>
        </div>
      </div>
@endsection
