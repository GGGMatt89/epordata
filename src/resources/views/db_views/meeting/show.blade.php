@extends ('layouts.db')

@section ('main_content_page')
    <div class="jumbotron" style="width: 80%; margin: auto; padding: 10px;">
        <div class="container">
            <div class='row'>
                <div class='col-12 col-lg-10'>
                    <h3 class="section_title">Dettagli appuntamento</h3>
                </div>
                <div class='col-3 col-lg-1 mx-auto'>
                   <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('meeting.edit', $meeting->id) }}"><i class="far fa-edit"></i></a>
                </div>
                <div class='col-3 col-lg-1 mx-auto'>
                    <form class='delete_form' id='{{$meeting->id}}_delete_form' action="{{ route('meeting.delete', $meeting->id)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$meeting->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
            <div class='row d-flex justify-content-center'>
                <hr class='show-sep'>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Cliente:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    <p class="lead">{{ $meeting->cust_name }} {{ $meeting->cust_surname }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Agente:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    <p class="lead">{{ $meeting->user->profile->last_name }} {{ $meeting->user->profile->first_name }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead lead-in">Indirizzo / modalità:</p>
                </div>
                <div class="form-group col-12 col-lg-8">
                    @if($meeting->remote)
                        <p class="lead">Appuntamento online/telefonico</p>
                    @else
                    @php
                        $symbols = array(" ", '"',"<", ">", "#", "%", "|");
                        $codes =array("+", "%22", "%3C", "%3E", "%23", "%25", "%7C");
                        $parameter = str_replace($symbols, $codes, $meeting->meet_address);
                    @endphp
                    <a class='simple-link' href="https://www.google.com/maps/search/?api=1&query={{$parameter}}" target='_blank'><p class="lead">{{ $meeting->meet_address }}</p></a>
                    @endif
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Il giorno </p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ date("d-m-Y", strtotime($meeting->scheduled_at))}}</p>
                </div>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">alle ore </p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ date("H:i", strtotime($meeting->scheduled_at))}}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Note:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    <p class="lead">{{ $meeting->notes }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
