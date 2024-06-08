@extends ('layouts.db')

@section('main_content_page')
              <div class='row'>
              <div class='col-12'>  
                <h3 class='section_title'>Crea profilo</h3>
                <hr class='styled-hr'> 
                <form method='POST' action='{{ route("profile.store") }}'>
                @csrf
                  <input name="user_id" id="user-id" type="hidden" value={{ Auth::user()->id }}>
              <div class='form-row'>
              <div class="form-group col-6">
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Nome">
              </div>
              <div class="form-group col-6">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Cognome">
              </div>
              </div> 
              <div class='form-row'> 
              <div class="form-group col-12">
                <input type="text" class="form-control" name="tax_code" id="tax_code" placeholder="Codice fiscale">
              </div>
              </div>
              <div class='form-row'> 
              <div class="form-group col-9">
                <input type="text" class="form-control" name="address" id="address" placeholder="Indirizzo">
              </div>
              <div class="form-group col-3">
                <input type="text" class="form-control" name="city" id="city" placeholder="Città">
              </div>
              </div>
              <div class='form-row'> 
              <div class="form-group col-8">
                <input type="text" class="form-control" name="area" id="area" placeholder="Area di competenza">
              </div>
              </div>
            <button type="submit" class="btn btn-primary btn-gradient btn-submit-form">Salva</button>
          </form>
        </div>
      </div>
@endsection 