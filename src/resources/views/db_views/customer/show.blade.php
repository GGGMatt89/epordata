@extends ('layouts.db')

@section ('main_content_page')
    <div class="jumbotron" style="width: 80%; margin: auto">
        <div class="container">
            <div class='row'>
                <div class='col-12 col-lg-8'>
                    <h3 class="section_title">{{$customer->title}} {{ $customer->first_name }} {{$customer->last_name}} - {{$customer->id}}</h3>
                </div>
                <div class='col-2 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-green-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Vedi acquisti" href="{{ route('purchase.index', ["customer_id"=>$customer->id]) }}"><i class="fas fa-shopping-cart"></i></a>
                </div>
                <div class='col-2 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-red-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Vedi iscrizioni a corsi" href="{{ route('participant.index', ["customer_id"=>$customer->id]) }}"><i class="fas fa-chalkboard-teacher"></i></a>
                </div>
                <div class='col-2 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('customer.edit', $customer->id) }}"><i class="far fa-edit"></i></a>
                </div>
                <div class='col-2 col-lg-1 mx-auto'>
                    <form class='delete_form' id='{{$customer->id}}_delete_form' action="{{ route('customer.delete', $customer->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$customer->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
            <div class='row'>
                <hr class='show-sep'>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <p class="lead lead-in">Attività:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-9">
                    <p class="lead">{{ $customer->bus_name }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <p class="lead lead-in">Categoria:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-9">
                    <p class="lead">{{ $customer->category }}</p>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-3">
                    <p class="lead lead-in">Curatore:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-9">
                    <p class="lead">{{ $customer->handler }}</p>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Rating:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-2">
                    <p class="lead">{{ $customer->rating }}</p>
                </div>
                <div class="form-group col-12 col-lg-2" style="padding-top:20px">
                    @php
                        $Rvalue = 0;
                        if ($customer->rating == 'Vip'){$Rvalue = 3;}
                        if ($customer->rating == 'Standard'){$Rvalue = 2;}
                        if ($customer->rating == 'Prospect'){$Rvalue = 1;}
                    @endphp
                    @for ($i = 0; $i < $Rvalue; $i++)
                        <span class="fa fa-star checked"></span>
                    @endfor
                    @for ($j = 0; $j < (3-$Rvalue); $j++)
                        <span class="fa fa-star"></span>
                    @endfor
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Codice cliente:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $customer->cus_code }}</p>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Codice univoco:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $customer->univ_code }}</p>
                </div>

            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Codice fiscale:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $customer->tax_code }}</p>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Partita IVA:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <p class="lead">{{ $customer->vat_num }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">E-mail:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <a class='simple-link' href="mailto:{{$customer->email}}" target="_blank"><p class="lead">{{ $customer->email }}</p></a>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">PEC:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <a class='simple-link' href="mailto:{{$customer->pec}}" target="_blank"><p class="lead">{{ $customer->pec }}</p></a>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in"><i class="fas fa-phone"></i> Ufficio:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <a class='simple-link' href="tel:{{$customer->office_phone}}"><p class="lead">{{$customer->office_phone}}</p></a>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in"><i class="fas fa-mobile-alt"></i> Cellulare:</p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-4">
                    <a class='simple-link' href="tel:{{$customer->mobile_phone}}"><p class="lead">{{$customer->mobile_phone}}</p></a>
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
                        $parameter = str_replace($symbols, $codes, $customer->address)."+".$customer->city;
                    @endphp
                    <a class='simple-link' href="https://www.google.com/maps/search/?api=1&query={{$parameter}}" target='_blank'><p class="lead">{{ $customer->address }}, {{$customer->post_code}} {{$customer->city}}</p></a>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-2">
                    <p class="lead lead-in">Provincia: </p>
                </div>
                <div class="form-group col-12 col-md-8 col-lg-3">
                    <p class="lead">{{ $customer->region }} </p>
                </div>
            </div>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingRef">
                        <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseRef" aria-expanded="true" aria-controls="collapseRef">
                            <i class="fas fa-chevron-down"></i>  Referente
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
                                    <p class="lead-card">{{$customer->ref_title}} {{ $customer->ref_name }} {{$customer->ref_surname}}</p>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="form-group col-4 col-md-2 col-lg-2">
                                    <p class="lead-card lead-in"><i class="far fa-envelope"></i> E-mail: </p>
                                </div>
                                <div class="form-group col-8 col-md-10 col-lg-4">
                                    <a class='simple-link' href="mailto:{{$customer->ref_email}}" target='_blank'><p class="lead-card">{{$customer->ref_email}}</p></a>
                                </div>
                                <div class="form-group col-4 col-md-2 col-lg-2">
                                    <p class="lead-card lead-in"><i class="fas fa-phone"></i> Telefono: </p>
                                </div>
                                <div class="form-group col-8 col-md-10 col-lg-4">
                                    <a class='simple-link' href="tel:{{$customer->ref_phone}}"><p class="lead-card">{{$customer->ref_phone}}</p></a>
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
        $(".btn-link").html('<i class="fas fa-chevron-down"></i>  Referente');
    });
    $("#collapseRef").on("show.bs.collapse", function () {
        $(".btn-link").html('<i class="fas fa-chevron-up"></i>  Referente');
    });
});
</script>
@endsection
