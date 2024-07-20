@extends ('layouts.db')

@section('main_content_page')
    <div class="jumbotron" style="width: 80%; margin:auto; padding: 10px;">
        <div class="container">
            <div class='row'>
                <div class="col-12 col-lg-10">
                    <h3 class="section_title">{{ $profile->first_name}} {{ $profile->last_name}} </h3>
                </div>
                <div class='col-1 col-lg-1'>
                   <a role="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href="{{ route('profile.edit', $profile->id) }}"><i class="far fa-edit"></i></a>
                </div>
                <div class='col-1 col-lg-1'>
                   <a role="button" class="btn btn-dark-green-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica credenziali" href="{{ route('user.editLimit', $profile->user->id) }}"><i class="fas fa-user-edit"></i></a>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-6 my-auto">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src={{ $profile->image }} alt="{{$profile->first_name}} {{$profile->last_name}}">
                    </div>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <p class="lead lead-in">ID:</p>
                    <p class="lead">{{$profile->user->name }}</p>
                    <p class="lead lead-in">Email:</p>
                    <p class="lead">{{$profile->user->email }}</p>
                </div>
            </div>
            <div class='row d-flex justify-content-center'>
                <hr class='show-sep'>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Indirizzo:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    <p class="lead">{{$profile->res_address }}, {{$profile->post_code}}, {{$profile->res_city}}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Codice fiscale:</p>
                </div>
                <div class="form-group col-12 col-lg-10">
                    <p class="lead">{{ $profile->tax_code  }}</p>
                </div>
            </div>
            <div class='row'>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Cellulare:</p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ $profile->mobile_phone }}</p>
                </div>
                <div class="form-group col-12 col-lg-2">
                    <p class="lead lead-in">Area:</p>
                </div>
                <div class="form-group col-12 col-lg-4">
                    <p class="lead">{{ $profile->area }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
