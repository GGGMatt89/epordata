@extends ('layouts.db')

@section('main_content_page')
  <script src="/js/forms_handling.js"></script>
  <div class='row'>
    <div class='col-12'>  
      <h3 class='section_title'>Modifica dettagli partecipante</h3>
      <h5 class='section_title'> di {{ $participant->first_name }} {{ $participant->last_name }}</h5>
      <h5 class='section_title'> per il corso/seminario {{ $participant->lecture->title }}</h5>
      <hr class='styled-hr'> 
      <form method='POST' action='{{ route("participant.update", $participant->id) }}'>
        @csrf
        @method('PUT') 
        <input name="customer_id" id="customer_id" value='{{$participant->customer_id}}' type="hidden">
        <input name="first_name" id="first_name" value='{{$participant->first_name}}' type="hidden">
        <input name="last_name" id="last_name" value='{{$participant->last_name}}' type="hidden">
        <input name="lecture_id" id="lecture_id" value='{{$participant->lecture_id}}' type="hidden">
      <div class='form-row'>
        <div class="form-group col-sm-12 col-md-6">
          <label class='db_form_label' for="role">Ruolo</label>
          <select class="selectpicker show-tick form-control {{ $errors->has('role') ? 'form-error' : ''}}" data-size="5" name="role" id="role" value="{{ $errors->any() ? old('role') : $participant->role  }}">
            @php
              $selected_role = $errors->any() ? old('role') : $participant->role;
            @endphp
            @foreach($roles as $role)
              <option value={{$role}} {{$selected_role == $role ? 'selected' : ''}}>{{$role}}</option>
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
              <input type="checkbox" class="{{ $errors->has('payed') ? 'form-error' : ''}}" name="payed" id="payed" {{ (($errors->any() && old('payed')) || $participant->payed) ? 'checked' : '' }}>
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
