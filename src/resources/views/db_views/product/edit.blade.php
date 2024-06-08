@extends ('layouts.db')

@section('main_content_page')
<script src="/js/forms_handling_product.js"></script>
  <div class='row'>
    <div class='col-12'>
      <h3 class='section_title'>Modifica prodotto</h3>
      <hr class='styled-hr'>
      <form method='POST' action='{{ route("product.update", $product->id) }}'>
        @csrf
        @method('PUT')
        <input name="provider_id" id="provider-id" type="hidden">
        <div class='form-row'>
          <div class="form-group col-12">
            <label class='db_form_label' for="name">Nome</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'form-error' : ''}}" name="name" id="name" value="{{ $errors->any() ? old('name') : $product->name  }}" placeholder="Nome">
            @error('name')
              <p class="error-input">{{ $errors->first('name')}}</p>
            @enderror
          </div>
          <div class="form-group col-12">
            <label class='db_form_label' for="code">Codice</label>
            <input type="text" class="form-control {{ $errors->has('code') ? 'form-error' : ''}}" name="code" id="code" value="{{ $errors->any() ? old('code') : $product->code  }}" placeholder="Codice prodotto">
            @error('code')
              <p class="error-input">{{ $errors->first('code')}}</p>
            @enderror
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-6">
            <label class='db_form_label' for="type">Tipo</label>
            <select class="selectpicker show-tick form-control {{ $errors->has('type') ? 'form-error' : ''}}" data-size="5" id="type" name="type" value="{{ $errors->any() ? old('type') : $product->type  }}">
              <option value=''>Seleziona tipo prodotto</option>
              <option data-divider="true"></option>
              @php
                $selected_type = $errors->any() ? old('type') : $product->type;
              @endphp
              @foreach($types as $type)
                <option value={{$type}} {{$selected_type == $type ? 'selected' : ''}}>{{$type}}</option>
              @endforeach
            </select>
            @error('type')
              <p class="error-input">{{ $errors->first('type')}}</p>
            @enderror
          </div>
          <div class="form-group col-6">
            <label class='db_form_label' for="category">Categoria</label>
            <select class="selectpicker show-tick form-control {{ $errors->has('category') ? 'form-error' : ''}}" data-size="5" name="category" id="category" value="{{ $errors->any() ? old('category') : $product->category  }}" placeholder="Categoria prodotto">
              <option value=''>Seleziona categoria prodotto</option>
              <option data-divider="true"></option>
              @php
                $selected_cat = $errors->any() ? old('category') : $product->category;
              @endphp
              @foreach($categories as $category)
                <option value={{$category}} {{$selected_cat == $category ? 'selected' : ''}}>{{$category}}</option>
              @endforeach
            </select>
            @error('category')
              <p class="error-input">{{ $errors->first('category')}}</p>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-12">
            <label class='db_form_label' for="prov-select">Fornitore</label>
            <select class="selectpicker show-tick form-control" id="prov-select" name="provider_id" data-size="5" data-live-search="true">
              <option value=''>Seleziona fornitore o aggiungilo manualmente</option>
              <option data-divider="true"></option>
              @php
                $selected_prov = $errors->any() ? old('provider_id') : $product->provider_id;
              @endphp
              @foreach ($providers as $provider)
                <option value='{{ $provider->id }}' {{$selected_prov == $provider->id ? 'selected' : ''}}>{{ $provider->bus_name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class='form-row'>
          <div class="form-group col-sm-12 col-md-6">
            <label class='db_form_label' for="provider_name">Nome fornitore</label>
            <input type="text" class="form-control {{ $errors->has('provider_name') ? 'form-error' : ''}}" name="provider_name" id="provider-name" value="{{ $errors->any() ? old('provider_name') : $product->provider_name  }}" placeholder="Nome">
            @error('provider_name')
              <p class="error-input">{{ $errors->first('provider_name')}}</p>
            @enderror
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva</button>
      </form>
    </div>
  </div>
@endsection
