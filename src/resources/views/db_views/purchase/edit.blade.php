@extends ('layouts.db')

@section('main_content_page')
  <div class='row'>
    <div class='col-12'>  
      <h3 class='section_title'>Modifica acquisto/abbonamento</h3>
      <h5 class='section_title'> di {{ $purchase->customer->title }} {{ $purchase->customer->last_name }}</h5>
      <h5 class='section_title'> per il prodotto {{ $purchase->product->name }}</h5>
      <hr class='styled-hr'> 
      <form method='POST' action='{{ route("purchase.update", $purchase->id) }}'>
        @csrf
        @method('PUT') 
        <input name="customer_id" id="customer_id" value='{{$purchase->customer_id}}' type="hidden">
        <input name="product_id" id="product_id" value='{{$purchase->product_id}}' type="hidden">
      <div class='form-row'>
        <div class="form-group col-sm-12 col-md-6">
          <label class='db_form_label' for="type">Tipo</label>
          <select class="selectpicker show-tick form-control {{ $errors->has('type') ? 'form-error' : ''}}" data-size="5" name="type" id="type" value="{{ $errors->any() ? old('type') : $purchase->type  }}">
            @php
              $selected_type = $errors->any() ? old('type') : $purchase->type;
            @endphp
            @foreach($types as $type)
              <option value={{$type}} {{$selected_type == $type ? 'selected' : ''}}>{{$type}}</option>
            @endforeach
          </select>
          @error('type')
            <p class="error-input">{{ $errors->first('type')}}</p>
          @enderror
        </div>
        <div class="form-group col-sm-12 col-md-6">
          <label class='db_form_label' for="expiration">Scadenza (abbonamento)</label>
          <input type="date" class="form-control {{ $errors->has('expiration') ? 'form-error' : ''}}" name="expiration" id="expiration" value="{{ $errors->any() ? old('expiration') : $purchase->expiration  }}" disabled>
          @error('expiration')
            <p class="error-input">{{ $errors->first('expiration')}}</p>
          @enderror
        </div>
      </div>
      <div class='form-row'> 
        <div class="form-group col-sm-12 col-md-12">
          <label class='db_form_label' for="notes">Note/dettagli</label>
          <textarea rows=4 class="form-control {{ $errors->has('notes') ? 'form-error' : ''}}" name="notes" id="notes" placeholder="Note">{{ $errors->any() ? old('notes') : $purchase->notes }}</textarea>
          @error('notes')
            <p class="error-input">{{ $errors->first('notes')}}</p>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva</button>
    </form>
  </div>
</div>
<script>
  $(document).ready(function () {
    if ($("#type").val() == 'Abbonamento') {
        $("#expiration").removeAttr("disabled");
    } else {
        $("#expiration").attr("disabled", "disabled");
    }
  });
  $("#type").change(function () {
    if ($(this).val() == 'Abbonamento') {
        $("#expiration").removeAttr("disabled");
        $("#expiration").focus();
    } else {
        $("#expiration").attr("disabled", "disabled");
    }
  });
</script>  
@endsection 
