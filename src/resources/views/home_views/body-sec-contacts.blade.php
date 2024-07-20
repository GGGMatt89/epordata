<!-- Contact -->
<section class="page-section" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Contattaci</h2>
          <h3 class="section-subheading">Visita il nostro ufficio in <a target="_blank" href="https://www.google.com/maps/place/Via+Camillo+Olivetti,+10%2FB,+10015+Ivrea+TO/@45.4618493,7.8708239,17z/data=!3m1!4b1!4m5!3m4!1s0x47888495557f7391:0xca5c0404752997f6!8m2!3d45.4618493!4d7.8730126">Via Camillo Olivetti 10b</a> ad Ivrea, o scrivici usando il form qui sotto</h3>
        </div>
      </div>
      {{-- <div class="row">
          <div class="col-lg-12 text-center" id="unesco">
            <a href="https://caffebook.it/2019/03/24/ivrea-la-bella-54-sito-italiano-del-patrimonio-dellunesco/" target="_blank" class="btn btn-primary btn-xl text-uppercase"><i class="fas fa-archway" style="padding-right: 20px"></i>IVREA - 54° sito italiano patrimonio UNESCO</a>
          </div>
        </div> --}}
      <div class="row">
        <div class="col-lg-12">
          <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" id="name" type="text" placeholder="Nome" required="required" data-validation-required-message="Inserisci il tuo nome.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="email" type="email" placeholder="Email" required="required" data-validation-required-message="Inserisci il tuo indirizzo email.">
                  <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                  <input class="form-control" id="phone" type="tel" placeholder="Telefono" required="required" data-validation-required-message="Inserisci il tuo numero di telefono.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <textarea class="form-control" id="message" placeholder="Il tuo messaggio" required="required" data-validation-required-message="Inserisci il tuo messaggio."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-12 text-center">
                <div id="success"></div>
                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Invia</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
