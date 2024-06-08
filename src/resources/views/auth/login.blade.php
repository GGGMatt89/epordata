@extends('layouts.main')

@section('main_content')
<div class="container" style="padding-top:50px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login Utente') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email" class="sr-only">Email</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text input-label"><i class="fas fa-user"></i></div>
                    </div>
                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <label for="password" class="sr-only">Password</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text input-label"><i class="fas fa-lock"></i></div>
                      </div>
                      <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Rimani connesso') }}
                        </label>
                    </div>

              <button style="margin-top: 30px" type="submit" class="btn btn-block btn-primary btn-gradient">{{ __('Login') }}</button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Hai dimenticato la password?') }}
                                </a>
                            @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
