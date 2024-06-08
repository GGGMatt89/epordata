
var loader = true; //{!! json_encode($loader) !!};
function close_loader(){
    window.loading_screen.finish();
}
if(loader==true){
    window.loading_screen = window.pleaseWait({
      logo: "/img/main_home/bkg.png",
      backgroundColor: 'rgb(5, 32, 66)',
      loadingHtml: '<div class="loader-wrapper"><span class="loader"><span class="loader-inner"><img src="/img/main_home/epordata_logo.png"></span></span></div>'
    })
    $(window).on("load",function(){
          window.setTimeout(close_loader, 3000);
          $("#mainNav").css("display", "inline");
    });
}
else{
    $('body').addClass('pg-loaded');
}
