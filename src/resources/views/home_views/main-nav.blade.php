<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="/img/main_home/logo_esteso.png"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Servizi</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#products">News</a>
          </li>
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#offers">Info & Offerte</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#history">Chi siamo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#team">Il team</a>
          </li>
          <li class="nav-item">
            <a id='contact-link' class="nav-link js-scroll-trigger" href="#contact">Contattaci</a>
          </li>
          @if (Route::has('login'))
              @auth
              <li class="nav-item dropdown notif">
                {{-- <a href="{{ url('/home') }}"><span><i class="fas fa-user fa-lg"></i></span>{{ Auth::user()->name }}</a> --}}
                <a class="nav-link dropdown-toggle user-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <mark></mark>
                  <span class="notification-badge  {{ $Nmeeting>0 ? 'd-block' : 'd-none'}}">{{$Nmeeting}}</span>
                  <span>
                  @if(Auth::user()->auth_level == 'Admin')
                    <i class="fas fa-crown fa-lg"></i>
                  @else
                    <i class="fas fa-user fa-lg"></i>
                  @endif
                  {{ Auth::user()->name }}
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{ route('db_home') }}">Gestionale</a></li>
                  {{-- <a class="dropdown-item" href="#">Calendario</a> --}}
                  <li><a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form></li>
                </ul>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}" ><span><i class="fas fa-user fa-lg"></i></span>Area privata</a>
                  {{-- href="{{ route('login') }}" data-toggle="modal" data-target="#loginMod"--}}
                  {{-- @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif --}}
              </li>
              @endauth
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>