<!-- Footer -->
<footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
        <span class="copyright">Ultimo aggiornamento: {{$maxdate ?? 'Vedi homepage'}}</span>
        </div>
        <div class="col-md-3">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a target="_blank" href="https://www.facebook.com/Epordata-112001073727199">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
                <a target="_blank" href="https://www.linkedin.com/company/epordata/">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
          </ul>
        </div>
        <div class="col-md-5">
          <ul class="list-inline quicklinks">
              <li class="list-inline-item">
              {{-- <a href="{{ route('home', ['loader'=>false]) }}">EPORDATA SAS</a> --}}
              </li>
            <li class="list-inline-item">
              <a target="_blank" href="mailto:info@epordata.it">info@epordata.it</a>
            </li>
            <li class="list-inline-item">
              <a target="_blank" href="tel:+39012548732">tel: 012548732</a>
            </li>
            <li class="list-inline-item">
                <a target="_blank" href="tel:+39012548576">tel: 012548576</a>
              </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
