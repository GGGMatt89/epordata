@extends ('layouts.db')

@section('main_content_page')
  <div class='row'>
    <div class='col-12'>  
      <h3 class='section_title'>Crea acquisto/abbonamento per : </h3>
      <h5 class='section_title'>{{ $page_title }}</h5>
      <hr class='styled-hr'> 
      <form method='POST' action='{{ route("purchase.store") }}'>
        @csrf 
      <div class='form-row'>
      @if($assoc == 'customer' || $assoc == null)
        <div class="form-group col-12 col-md-6">
          @if($assoc == 'customer')
          <input name="customer_id" id="customer_id" value='{{$customers->id}}' type="hidden">
          @endif
          <label class='db_form_label' for="product_id_ed">Editoria</label>
          <select class="selectpicker show-tick form-control {{ $errors->has('product_id_ed') ? 'form-error' : ''}}" data-size="5" data-live-search="true" id="product_id_ed" name="product_id_ed">
            <option value=" ">Seleziona prodotto editoria</option>
            <option data-divider="true"></option>
            @php
              $selected_prod_ed = $errors->any() ? old('product_id_ed') : '';
            @endphp
            @foreach($products as $product)
              @if($product->type == 'Editoria')
              <option value='{{$product->id}}' {{$selected_prod_ed == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
              @endif
            @endforeach
          </select>
          @error('product_id_ed')
            <p class="error-input">{{ $errors->first('product_id_ed')}}</p>
          @enderror
        </div>
        <div class="form-group col-12 col-md-6">
          <label class='db_form_label' for="product_id_form">Formazione</label>
          <select class="selectpicker show-tick form-control {{ $errors->has('product_id_form') ? 'form-error' : ''}}" data-size="5" data-live-search="true" id="product_id_form" name="product_id_form">
            <option value=" ">Seleziona prodotto formazione</option>
            <option data-divider="true"></option>
            @php
              $selected_prod_form = $errors->any() ? old('product_id_form') : '';
            @endphp
            @foreach($products as $product)
              @if($product->type == 'Formazione')
              <option value='{{$product->id}}' {{$selected_prod_form == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
              @endif
            @endforeach
          </select>
          @error('product_id_form')
            <p class="error-input">{{ $errors->first('product_id_form')}}</p>
          @enderror
        </div>
      @endif
      @if($assoc == 'product' || $assoc == null)
        <div class="form-group col-12 col-md-12">
          @if($assoc == 'product')
          <input name="product_id_ed" id="product_id_ed" value='{{$products->id}}' type="hidden">
          <input name="product_id_form" id="product_id_form" value=' ' type="hidden">
          @endif
          <label class='db_form_label' for="customer_id">Cliente</label>
          <select class="selectpicker show-tick form-control {{ $errors->has('customer_id') ? 'form-error' : ''}}" data-size="5" data-live-search="true" id="customer_id" name="customer_id">
            <option value=" ">Seleziona cliente</option>
            <option data-divider="true"></option>
            @php
              $selected_cust = $errors->any() ? old('customer_id') : '';
            @endphp
            @foreach($customers as $customer)
              <option value='{{$customer->id}}' {{$selected_cust == $customer->id ? 'selected' : ''}}>{{$customer->title}} {{$customer->first_name}} {{$customer->last_name}}</option>
            @endforeach
          </select>
          @error('customer_id')
            <p class="error-input">{{ $errors->first('customer_id')}}</p>
          @enderror
        </div>
      @endif
      </div>
      <div class='form-row'> 
        <div class="form-group col-sm-12 col-md-6">
          <label class='db_form_label' for="type">Tipo</label>
          <select class="selectpicker show-tick form-control {{ $errors->has('type') ? 'form-error' : ''}}" data-size="5" name="type" id="type" value="{{ old('type') }}">
            @php
              $selected_type = $errors->any() ? old('type') : '';
            @endphp
            @foreach($types as $type)
              <option value='{{$type}}' {{$selected_type == $type ? 'selected' : ''}}>{{$type}}</option>
            @endforeach
          </select>
          @error('type')
            <p class="error-input">{{ $errors->first('type')}}</p>
          @enderror
        </div>
        <div class="form-group col-sm-12 col-md-6">
          <label class='db_form_label' for="expiration">Scadenza (abbonamento)</label>
          <input type="date" class="form-control {{ $errors->has('expiration') ? 'form-error' : ''}}" name="expiration" id="expiration" value="{{ old('expiration') }}" placeholder="Scadenza" disabled>
          @error('expiration')
            <p class="error-input">{{ $errors->first('expiration')}}</p>
          @enderror
        </div>
      </div>
      <div class='form-row'> 
        <div class="form-group col-sm-12 col-md-12">
          <label class='db_form_label' for="notes">Note/dettagli</label>
          <textarea rows=4 class="form-control {{ $errors->has('notes') ? 'form-error' : ''}}" name="notes" id="notes" placeholder="Note">{{ old('notes') }}</textarea>
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
