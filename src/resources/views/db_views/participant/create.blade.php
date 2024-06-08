@extends ('layouts.db')

@section('main_content_page')
  <script src="/js/forms_handling_participant.js"></script>
  <div class='row'>
    <div class='col-12'>  
    <h3 class='section_title'>{{$page_title ?? ''}}</h3>
    <hr class='styled-hr'> 
      <form method='POST' action='{{ route("participant.store") }}'>
        @csrf 
      @if($assoc == 'customer' || $assoc == null)
      <div class='form-row'>
        <div class="form-group col-12 col-md-12">
          @if($assoc == 'customer')
          <input name="customer_id" id="customer_id" value='{{$customers->id}}' type="hidden">
          <input name="first_name" id="first_name" value='{{$customers->first_name}}' type="hidden">
          <input name="last_name" id="last_name" value='{{$customers->last_name}}' type="hidden">
          @endif
          <label class='db_form_label' for="lecture_id">Corso / seminario</label>
          <select class="selectpicker show-tick form-control {{ $errors->has('lecture_id') ? 'form-error' : ''}}" data-size="5" data-live-search="true" id="lecture_id" name="lecture_id">
            <option value=" ">Seleziona corso/seminario</option>
            <option data-divider="true"></option>
            @php
              $selected_lec = $errors->any() ? old('lecture_id') : '';
            @endphp
            @foreach($lectures as $lecture)
              <option value='{{$lecture->id}}' {{$selected_lec == $lecture->id ? 'selected' : ''}}>{{$lecture->title}}</option>
            @endforeach
          </select>
          @error('lecture_id')
            <p class="error-input">{{ $errors->first('lecture_id')}}</p>
          @enderror
        </div>
      </div>
      @endif
      @if($assoc == 'lecture' || $assoc == null)
       <div class='form-row'>
        <div class="form-group col-12 col-md-12">
          @if($assoc == 'lecture')
          <input name="lecture_id" id="lecture_id" value='{{$lectures->id}}' type="hidden">
          @endif
          <label class='db_form_label' for="customer_id">Cliente</label>
          <select class="selectpicker show-tick form-control {{ $errors->has('customer_id') ? 'form-error' : ''}}" data-size="5" data-live-search="true" id="customer_id" name="customer_id">
            <option value=" ">Seleziona cliente o inserisci i dati manualmente</option>
            <option data-divider="true"></option>
            @php
              $selected_cus = $errors->any() ? old('customer_id') : '';
            @endphp
            @foreach($customers as $customer)
              <option value='{{$customer->id}}' {{$selected_cus == $customer->id ? 'selected' : ''}}>{{$customer->title}} {{$customer->first_name}} {{$customer->last_name}}</option>
            @endforeach
          </select>
          @error('customer_id')
            <p class="error-input">{{ $errors->first('customer_id')}}</p>
          @enderror
        </div>
      </div>
        <div class='form-row'> 
        <div class="form-group col-sm-12 col-md-6">
          <label class='db_form_label' for="first_name">Nome</label>
          <input type='text' class="form-control {{ $errors->has('first_name') ? 'form-error' : ''}}" name="first_name" id="first_name" value="{{ old('first_name') }}">
          @error('first_name')
            <p class="error-input">{{ $errors->first('first_name')}}</p>
          @enderror
        </div>
        <div class="form-group col-sm-12 col-md-6">
          <label class='db_form_label' for="last_name">Cognome</label>
          <input type="text" class="form-control {{ $errors->has('last_name') ? 'form-error' : ''}}" name="last_name" id="last_name" value="{{ old('last_name') }}">
          @error('last_name')
            <p class="error-input">{{ $errors->first('last_name')}}</p>
          @enderror
        </div>
      </div>
      @endif
      <div class='form-row'> 
        <div class="form-group col-sm-12 col-md-6">
          <label class='db_form_label' for="type">Ruolo</label>
          <select class="form-control {{ $errors->has('role') ? 'form-error' : ''}}" name="role" id="role" value="{{ old('role') }}">
            @php
              $selected_role = $errors->any() ? old('role') : '';
            @endphp
            @foreach($roles as $role)
              <option value='{{$role}}' {{$selected_role == $role ? 'selected' : ''}}>{{$role}}</option>
            @endforeach
          </select>
          @error('role')
            <p class="error-input">{{ $errors->first('role')}}</p>
          @enderror
        </div>
        <div class="form-check col-sm-12 col-md-6">
          <div class="checkbox-container">
            <p class='db_form_label input-title'>Pagato?</p>
            <label class="checkbox-label" for="payed">
              <input type="checkbox" class="{{ $errors->has('payed') ? 'form-error' : ''}}" name="payed" id="payed" {{ old('payed') ? 'checked' : ''}}>
              <span class="checkbox-custom rectangular"></span>
            </label>
          </div>
          @error('payed')
            <p class="error-input">{{ $errors->first('payed')}}</p>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva</button>
    </form>
  </div>
</div>
@endsection 
