<!-- Navigation -->
@php
  $url = url()->current();
@endphp
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="dbNav">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home', ['loader'=>false]) }}"><img src="/img/main_home/epordata_logo.png"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link {{ strpos($url, 'home') ? 'active' : ''}}" href="{{ route('db_home') }}"><i class="fas fa-home fa-lg"></i>Home personale</a>
          </li>
          @if(Auth::user()->auth_level == 'Admin')
            <li class="nav-item">
              <a class="nav-link {{ strpos($url, 'profile') ? 'active' : ''}}" href="{{ route('profile.index') }}">Profili utenti</a>
            </li>
          @endif
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ strpos($url, 'customer') ? 'active' : ''}}" href="#" id="customer-dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clienti</a>
             <div class="dropdown-menu" aria-labelledby="customer-dropdown">
              <a class="dropdown-item" href="{{ route('customer.index') }}">Tutti</a>
              <a class="dropdown-item" href="{{ route('customer.index', ['personal'=>true]) }}">Solo miei</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ strpos($url, 'product') ? 'active' : ''}}" href="{{ route('product.index') }}">Prodotti</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ strpos($url, 'provider') ? 'active' : ''}}" href="{{ route('provider.index') }}">Fornitori</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ strpos($url, 'meeting') ? 'active' : ''}}" href="#" id="meeting-dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Appuntamenti</a>
            <div class="dropdown-menu" aria-labelledby="meeting-dropdown">
              <a class="dropdown-item" href="{{ route('meeting.index') }}">Tutti</a>
              <a class="dropdown-item" href="{{ route('meeting.index', ['personal'=>true]) }}">Tutti miei</a>
              <a class="dropdown-item" href="{{ route('meeting.index', ['future'=>true]) }}">Tutti futuri</a>
              <a class="dropdown-item" href="{{ route('meeting.index', ['personal'=>true, 'future'=>true]) }}">Solo miei e futuri</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ strpos($url, 'lecture') ? 'active' : ''}}" href="{{ route('lecture.index') }}">Corsi</a>
          </li>
          @auth
          <li class="nav-item dropdown notif">
            <a class="nav-link dropdown-toggle" href="#" id="auth-dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <mark></mark>
                @if(Auth::user()->auth_level == 'Admin')
                  <i class="fas fa-crown fa-lg"></i>
                @else
                  <i class="fas fa-user fa-lg"></i>
                @endif
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="auth-dropdown">
              <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->profile) }}">Il mio profilo</a>
              @if (Auth::user()->auth_level == 'Admin' || Auth::user()->auth_level == 'Operator')
                @if (Route::has('register'))
                  <a class="dropdown-item" href="{{ route('register') }}">Aggiungi utente</a>
                @endif
                <a class="dropdown-item" href="{{ route('user.index') }}">Rimuovi/modifica utente</a>
              @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
