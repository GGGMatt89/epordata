@extends ('layouts.db')

@section('main_content_page')
  <div class='row'>
    <div class='col-12'>
      <h3 class='section_title'>Modifica corso / seminario</h3>
      <hr class='styled-hr'>
      <form method='POST' action='{{ route("lecture.update", $lecture->id) }}'>
        @csrf
        @method('PUT')
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-12">
            <label class='db_form_label' for="title">Titolo</label>
            <input type="text" class="form-control {{ $errors->has('title') ? 'form-error' : ''}}" name="title" id="title" value="{{ $errors->any() ? old('title') : $lecture->title }}" placeholder="Titolo">
            @error('title')
              <p class="error-input">{{ $errors->first('title')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-12">
            <label class='db_form_label' for="description">Descrizione</label>
            <textarea rows=4 class="form-control {{ $errors->has('description') ? 'form-error' : ''}}" name="description" id="description" placeholder="Descrizione">{{ $errors->any() ? old('description') : $lecture->description }}</textarea>
            @error('description')
              <p class="error-input">{{ $errors->first('description')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="beg_date">Data inizio</label>
            <input type="date" class="form-control {{ $errors->has('beg_date') ? 'form-error' : ''}}" name="beg_date" id="beg_date" value="{{ $errors->any() ? old('beg_date') : date("Y-m-d", strtotime($lecture->beginning)) }}" placeholder="Data inizio">
            @error('beg_date')
              <p class="error-input">{{ $errors->first('beg_date')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="beg_time">Ora inizio</label>
            <input type="time" class="form-control {{ $errors->has('beg_time') ? 'form-error' : ''}}" name="beg_time" id="beg_time" value="{{ $errors->any() ? old('beg_time') : date("H:i", strtotime($lecture->beginning)) }}" placeholder="Ora inizio">
            @error('beg_time')
              <p class="error-input">{{ $errors->first('beg_time')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="end_date">Data fine</label>
            <input type="date" class="form-control {{ $errors->has('end_date') ? 'form-error' : ''}}" name="end_date" id="end_date" value="{{ $errors->any() ? old('end_date') : date("Y-m-d", strtotime($lecture->end)) }}" placeholder="Data fine">
            @error('beg_date')
              <p class="error-input">{{ $errors->first('beg_date')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="end_time">Ora fine</label>
            <input type="time" class="form-control {{ $errors->has('end_time') ? 'form-error' : ''}}" name="end_time" id="end_time" value="{{ $errors->any() ? old('end_time') : date("H:i", strtotime($lecture->end)) }}" placeholder="Ora fine">
            @error('end_time')
              <p class="error-input">{{ $errors->first('end_time')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-12">
            <label class='db_form_label' for="place">Luogo</label>
            <input type="text" class="form-control {{ $errors->has('place') ? 'form-error' : ''}}" name="place" id="place" value="{{ $errors->any() ? old('place') : $lecture->place }}" placeholder="Luogo">
            @error('place')
              <p class="error-input">{{ $errors->first('place')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="last">Durata</label>
            <input type="text" class="form-control {{ $errors->has('last') ? 'form-error' : ''}}" name="last" id="last" value="{{ $errors->any() ? old('last') : $lecture->last }}" placeholder="Durata">
            @error('last')
              <p class="error-input">{{ $errors->first('last')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="cfp">C.F.P.</label>
            <input type="number" class="form-control {{ $errors->has('cfp') ? 'form-error' : ''}}" name="cfp" id="cfp" value="{{ $errors->any() ? old('cfp') : $lecture->cfp }}" placeholder="C.F.P.">
            @error('cfp')
              <p class="error-input">{{ $errors->first('cfp')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="price">Prezzo</label>
            <input type="number" class="form-control {{ $errors->has('price') ? 'form-error' : ''}}" name="price" id="price" value="{{ $errors->any() ? old('price') : $lecture->price }}" placeholder="Prezzo">
            @error('price')
              <p class="error-input">{{ $errors->first('price')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="cr_body">Ente accreditante</label>
            <input type="text" class="form-control {{ $errors->has('cr_body') ? 'form-error' : ''}}" name="cr_body" id="cr_body" value="{{ $errors->any() ? old('cr_body') : $lecture->cr_body }}" placeholder="Ente accreditante">
            @error('cr_body')
              <p class="error-input">{{ $errors->first('cr_body')}}</p>
            @enderror
          </div>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="provider">Fornitore</label>
            <input type="text" class="form-control {{ $errors->has('provider') ? 'form-error' : ''}}" name="provider" id="provider" value="{{ $errors->any() ? old('provider') : $lecture->provider }}" placeholder="Fornitore">
            @error('provider')
              <p class="error-input">{{ $errors->first('provider')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-12">
            <label class='db_form_label' for="product_id">Seleziona un prodotto se il corso / seminario si riferisce ad un prodotto a catalogo</label>
            <select class="selectpicker show-tick form-control {{ $errors->has('product_id') ? 'form-error' : ''}}" data-size="5" data-live-search="true" id="product_id" name="product_id">
              <option value= ' '>Seleziona un prodotto</option>
              <option data-divider="true"></option>
              @php
                $selected_prod = $errors->any() ? old('product_id') : $lecture->product_id;
              @endphp
              @foreach ($products as $product)
                <option value='{{ $product->id }}' {{$selected_prod == $product->id ? 'selected' : ''}}>{{ $product->name }} - {{ $product->code }}</option>
              @endforeach
            </select>
            @error('product_id')
              <p class="error-input">{{ $errors->first('product_id')}}</p>
            @enderror
          </div>
        </div>
            <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva modifiche</button>
          </form>
        </div>
      </div>
@endsection
