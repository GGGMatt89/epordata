<!-- News -->
<section class="bg-light page-section" id="products">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">News</h2>
          <h3 class="section-subheading text-muted">Tutte le ultime novità sui prodotti e sulle attività del gruppo.</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-12 mx-auto">
          @if( count($news_all) == 0 )
            <div class="text-center">
              <h4> <a href="#contact" class="js-scroll-trigger">Contattaci</a> per restare costantemente aggiornato! </h4>
            </div>
          @else
            <div id="carouselNews" class="carousel slide offers-carousel" data-ride="carousel" data-interval="2000">
              <ol class="carousel-indicators">
                @foreach($news_all as $news)
                  <li data-target="#carouselNews" data-slide-to="{{$loop->index}}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
              </ol>
              <div class="carousel-inner">
                @foreach($news_all as $news)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                      <img class="d-block w-100 my-auto" src={{$news->image_path}} alt="{{$news->preview_title}}">
                      <div class="carousel-caption">
                        <h5>{{$news->preview_title}}</h5>
                        <p class='d-none d-lg-block'>{{$news->preview_subtitle}}</p>
                        <a class="btn btn-primary btn-to-modal text-uppercase" data-toggle="modal" href="#news{{$news->id}}Modal">Scopri di più</a>
                      </div>
                    </div>
                @endforeach
              </div>
              @if(count($news_all) > 1)
              <a class="carousel-control-prev" href="#carouselNews" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Precedente</span>
              </a>
              <a class="carousel-control-next" href="#carouselNews" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Successivo</span>
              </a>
              @endif
            </div>
            @endif
        </div>
        <div class="col-lg-4 col-md-4 col-12 mx-auto overflow-auto " style='max-height: 70vh'>
          @foreach($news_all as $news)
            <div class="col-12 d-none d-lg-block">
              <h5><i class="far fa-newspaper"></i> <a class='news_title_link' data-toggle="modal" href="#news{{$news->id}}Modal">{{$news->preview_title}}</a></h5>
              <hr width="90%" size="5" align="center">
            </div>
          @endforeach
        </div>
    </div>
    </div>
  </section>


  <!-- Modali NEWS -->
  @foreach($news_all as $news)
    <div class="products-modal modal fade" id="news{{$news->id}}Modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                <!-- News Details Go Here -->
                <h2 class="text-uppercase">{{$news->title}}</h2>
                <p class="item-intro text-uppercase">{{$news->excerpt}}</p>
                <img class="img-fluid d-block mx-auto my-auto" src={{$news->image_path}} alt="{{$news->preview_title}}">
                <p class="item-text">{{$news->body}}</p>
                <ul class="list-inline">
                  <li>Pubblicata il : {{ Carbon\Carbon::parse($news -> date) -> toDateString() }}</li>
                  <li>Categoria: Novità</li>
                </ul>
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i>
                  Chiudi</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach