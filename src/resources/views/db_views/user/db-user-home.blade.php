<script src="/js/home_calendar.js"></script>
@if (count($users) > 1)
    <div class='form-row items-center'>
      <div class="form-group col-12 col-md-6">
        <label class='db_form_label' for="user_id">Appuntamenti di: </label>
        <select class="selectpicker show-tick  form-control {{ $errors->has('user_id') ? 'form-error' : ''}}" data-size="5" name="user_id" id="user_id" value="{{ old('user_id') }}" data-live-search="true">
          <option value=' ' selected>Tutti</option>
          <option data-divider="true"></option>
          @php
            $selected_prof = $errors->any() ? old('user_id') : Auth::user()->id;
          @endphp
          @foreach($users as $user)
            <option value='{{$user->id}}' {{$selected_prof == $user->id ? 'selected' : ''}}>{{$user -> profile -> first_name}} {{$user -> profile -> last_name}}</option>
          @endforeach
        </select>
        @error('user_id')
          <p class="error-input">{{ $errors->first('user_id')}}</p>
        @enderror
      </div>
    </div>
@else
    @php
        $selected_prof = Auth::user()->id;
    @endphp
@endif

<div class='justify-content-center' id='calendar' style='width: 100%; margin-top: 20px'>
</div>

<script>
    let array_events = @json($meetings);
    let today = new Date();
    let feat = 'future';
    let setId = '{{$selected_prof}}';
    // let events = prepareMeetings(array_events, col_obj, today);
    // let dd = String(today.getDate()).padStart(2, '0');
    // let mm = String(today.getMonth() + 1).padStart(2, '0');
    // let yyyy = today.getFullYear();
    // today = yyyy + '-' + mm + '-' + dd;
    let calendarEl = document.getElementById('calendar');
    let calendar = createCalendar(calendarEl, col_obj);
    document.addEventListener('DOMContentLoaded', calendar.render());
    let selection = document.getElementById('user_id');
    if(selection){
        selection.addEventListener('change', (event) => calendar.refetchEvents());
    }
</script>
