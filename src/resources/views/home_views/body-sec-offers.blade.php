<!-- Offerte -->
<section class="bg-light page-section" id="offers">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Info & Offerte</h2>
          <h3 class="section-subheading text-muted">Informazioni su prodotti e servizi e offerte in corso. <a href="#contact" class = "js-scroll-trigger">Contattaci</a> per maggiori informazioni!</h3>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-12 text-center">
          <h4 class="section-heading text-uppercase">INFO</h4>
        @if(count($infos) == 0 )
          <div class="text-center">
            <h4> <a href="#contact" class="js-scroll-trigger">Contattaci</a> per restare costantemente aggiornato! </h4>
          </div>
        @else
        <div id="carouselInfos" class="carousel slide offers-carousel" data-ride="carousel" data-interval="2000">
              <ol class="carousel-indicators">
                @foreach($infos as $info)
                  <li data-target="#carouselInfos" data-slide-to="{{$loop->index}}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
              </ol>
              <div class="carousel-inner">
                @foreach($infos as $info)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                      <img class="d-block w-100 my-auto" src={{$info->image_path}} alt="{{$info->preview_title}}">
                      <div class="carousel-caption">
                        <h5>{{$info->preview_title}}</h5>
                        <p class='d-none d-lg-block'>{{$info->preview_subtitle}}</p>
                        <a class="btn btn-primary btn-to-modal text-uppercase" data-toggle="modal" href="#info{{$info->id}}Modal">Scopri di più</a>
                      </div>
                    </div>
                @endforeach
              </div>
              @if(count($infos) > 1)
              <a class="carousel-control-prev" href="#carouselInfos" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Precedente</span>
              </a>
              <a class="carousel-control-next" href="#carouselInfos" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Successivo</span>
              </a>
              @endif
            </div>
          @endif
        </div>
        <!-- OFFERTE -->
        <div class="col-lg-6 col-md-6 col-12 text-center">
          <h4 class="section-heading text-uppercase">OFFERTE</h4>
          @if(count($offers)==0)
              <div class="text-center">
                <h4>  Nessuna offerta attualmente attiva! <a href="#contact" class="js-scroll-trigger"> Contattaci</a> per informazioni sulle offerte future! </h4>
              </div>
          @else
            <div id="carouselOffers" class="carousel slide offers-carousel" data-ride="carousel" data-interval="2000">
              <ol class="carousel-indicators">
                @foreach($offers as $offer)
                  @php($date_expir = \Carbon\Carbon::parse($offer->expiration))
                  @if ($date_expir->isFuture())
                    <li data-target="#carouselOffers" data-slide-to="{{$loop->index}}" class="{{ $loop->first ? 'active' : '' }}"></li>
                  @endif
                @endforeach
              </ol>
              <div class="carousel-inner">
                @foreach($offers as $offer)
                  @php($date_expir = \Carbon\Carbon::parse($offer->expiration))
                  @if ($date_expir->isFuture())
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                      <img class="d-block w-100 my-auto" src={{$offer->image_path}} alt="{{$offer->preview_title}}">
                      <div class="carousel-caption">
                        <h5>{{$offer->preview_title}}</h5>
                        <p class='d-none d-lg-block'>{{$offer->preview_subtitle}}</p>
                        <a class="btn btn-primary btn-to-modal text-uppercase" data-toggle="modal" href="#offer{{$offer->id}}Modal">Scopri di più</a>
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>
              @if(count($offers) > 1)
              <a class="carousel-control-prev" href="#carouselOffers" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Precedente</span>
              </a>
              <a class="carousel-control-next" href="#carouselOffers" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Successivo</span>
              </a>
              @endif
            </div>
           @endif
           </div>
          </div>
      </div>
  </section>


  <!-- Modali OFFERTE-->
  @foreach($offers as $offer)
    <div class="products-modal modal fade" id="offer{{$offer->id}}Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Offer Details Go Here -->
                <h2 class="text-uppercase">{{$offer->title}}</h2>
                <p class="item-intro text-uppercase">{{$offer->excerpt}}</p>
                <img class="img-fluid d-block mx-auto my-auto" src={{$offer->image_path}} alt="{{$offer->preview_title}}">
                <p class="item-text">{{$offer->body}}</p>
                <ul class="list-inline">
                  <li>Inizio: {{ Carbon\Carbon::parse($offer -> beginning) -> toDateString() }}</li>
                  <li>Fine: {{ Carbon\Carbon::parse($offer -> expiration) -> toDateString() }}</li>
                  <li>Categoria: Offerte</li>
                </ul>
                <ul class="list-inline">
                    <li><button class="btn btn-lg btn-highlight btn-modal-contacts" type="button" onclick="goToContacts(this)" data-modalCloseId="offer{{$offer->id}}Close" data-subject="Richiesta per OFFERTA: {{$offer->preview_title}}">
                      Contattaci subito!</button></li>
                    <li><button id="offer{{$offer->id}}Close" class="btn btn-primary btn-close-modal" data-dismiss="modal" type="button">
                      <i class="fas fa-times"></i>
                      Chiudi</button></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <!-- Modali INFO-->
  @foreach($infos as $info)
    <div class="products-modal modal fade" id="info{{$info->id}}Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Info Details Go Here -->
                <h2 class="text-uppercase">{{$info->title}}</h2>
                <p class="item-intro text-uppercase">{{$info->excerpt}}</p>
                <img class="img-fluid d-block mx-auto my-auto" src={{$info->image_path}} alt="{{$info->preview_title}}">
                <p class="item-text">{{$info->body}}</p>
                <ul class="list-inline">
                  <li>Ultima modifica: {{ Carbon\Carbon::parse($info->updated_at) -> toDateString() }}
                  <li>Categoria: Info</li>
                </ul>
                <ul class="list-inline">
                    <li><button class="btn btn-lg btn-highlight btn-modal-contacts" onclick="goToContacts(this)" type="button" data-modalCloseId="info{{$info->id}}Close" data-subject="Richiesta per INFO: {{$info->preview_title}}">
                      Contattaci subito!</button></li>
                    <li><button id="info{{$info->id}}Close" class="btn btn-primary btn-close-modal" data-dismiss="modal" type="button">
                      <i class="fas fa-times"></i>
                      Chiudi</button></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
