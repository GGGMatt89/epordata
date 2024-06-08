@extends ('layouts.db')

@section ('main_content_page')
    <div class="jumbotron" style="width: 80%; margin: auto">
        <div class="container">
            <div class='row'>
                <div class='col-12 col-lg-10'>
                    <h3 class="section_title">{{$provider->bus_name}}</h3>
                </div>
                <div class='col-3 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('provider.edit', $provider->id) }}"><i class="far fa-edit"></i></a>
                </div>
                <div class='col-3 col-lg-1 mx-auto'>
                    <form class='delete_form' id='{{$provider->id}}_delete_form' action="{{ route('provider.delete', $provider->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$provider->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
            <div class='row'>
                <hr class='show-sep'>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4">
                    <p class="lead lead-in">Codice fornitore:</p>
                </div>
                <div class="form-group col-12 col-md-8">
                    <p class="lead">{{ $provider->code }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4">
                    <p class="lead lead-in">Categoria:</p>
                </div>
                <div class="form-group col-12 col-md-8">
                    <p class="lead">{{ $provider->category }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Codice fiscale:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $provider->tax_code }}</p>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Partita IVA:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $provider->vat_num }}</p>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Codice univoco:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $provider->univ_code }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-4">
                    <p class="lead lead-in"><i class="far fa-envelope"></i> E-mail:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-8">
                    <a class='simple-link' href="mailto:{{$provider->email}}" target="_blank"><p class="lead">{{ $provider->email }}</p></a>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-4">
                    <p class="lead lead-in"><i class="far fa-envelope"></i> PEC:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-8">
                    <a class='simple-link' href="mailto:{{$provider->pec}}" target="_blank"><p class="lead">{{ $provider->pec }}</p></a>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in"><i class="fas fa-phone"></i> Ufficio:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <a class='simple-link' href="tel:{{$provider->office_phone}}"><p class="lead">{{$provider->office_phone}}</p></a>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in"><i class="fas fa-mobile-alt"></i> Cellulare:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <a class='simple-link' href="tel:{{$provider->mobile_phone}}"><p class="lead">{{$provider->mobile_phone}}</p></a>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Indirizzo: </p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-5">
                    @php
                        $symbols = array(" ", '"',"<", ">", "#", "%", "|");
                        $codes =array("+", "%22", "%3C", "%3E", "%23", "%25", "%7C");
                        $parameter = str_replace($symbols, $codes, $provider->address)."+".$provider->city;
                    @endphp
                    <a class='simple-link' href="https://www.google.com/maps/search/?api=1&query={{$parameter}}" target='_blank'><p class="lead">{{ $provider->address }}, {{$provider->post_code}} {{$provider->city}}</p></a>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Provincia: </p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-3">
                    <p class="lead">{{ $provider->region }} </p>
                </div>
            </div>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingRef">
                        <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseRef" aria-expanded="true" aria-controls="collapseRef">
                            <i class="fas fa-chevron-down"></i> Referente
                        </button>
                        </h5>
                    </div>
                    <div id="collapseRef" class="collapse" aria-labelledby="headingRef" data-parent="#accordion">
                        <div class="card-body">
                            <div class='row'>
                                <div class="form-group col-4 col-md-2">
                                    <p class="lead-card lead-in"><i class="fas fa-user fa-lg"></i> </p>
                                </div>
                                <div class="form-group col-8 col-md-10">
                                    <p class="lead-card">{{$provider->ref_title}} {{ $provider->ref_name }} {{$provider->ref_surname}}</p>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="form-group col-4 col-md-2 col-lg-2">
                                    <p class="lead-card lead-in"><i class="far fa-envelope"></i> E-mail: </p>
                                </div>
                                <div class="form-group col-8 col-md-10 col-lg-4">
                                    <a class='simple-link' href="mailto:{{$provider->ref_email}}" target='_blank'><p class="lead-card">{{$provider->ref_email}}</p></a>
                                </div>
                                <div class="form-group col-4 col-md-2 col-lg-2">
                                    <p class="lead-card lead-in"><i class="fas fa-phone"></i> Telefono: </p>
                                </div>
                                <div class="form-group col-8 col-md-10 col-lg-4">
                                    <a class='simple-link' href="tel:{{$provider->ref_phone}}"><p class="lead-card">{{$provider->ref_phone}}</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<script>
    $(document).ready(function () {
    $("#collapseRef").on("hide.bs.collapse", function () {
        $(".btn-link").html('<i class="fas fa-chevron-down"></i> Referente');
    });
    $("#collapseRef").on("show.bs.collapse", function () {
        $(".btn-link").html('<i class="fas fa-chevron-up"></i> Referente');
    });
});
</script>
@endsection
