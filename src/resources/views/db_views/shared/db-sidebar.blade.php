<div class='text-center' id='sidebar' style='width: 90%; margin: 5%'>
    <div class='row mb-3 mx-auto'>
    <div class='col-6'>
      <a role="button" class="btn btn-tooltip btn-back" data-toggle="tooltip" data-placement="bottom" title="Back" href="{{ url()->previous() }}"><i class="fas fa-caret-left"></i></a>
    </div>
    </div>
    <hr class='styled-hr'>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card bg-darkblue text-white d-none d-lg-block">
            <h3 class="card-title text-center">
                <div class="clock-badge d-flex flex-wrap justify-content-center mt-2">
                    <a><span class="badge hours"></span></a> :
                    <a><span class="badge min"></span></a> :
                    <a><span class="badge sec"></span></a>
                </div>
            </h3>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-none d-lg-block profile-img">
            <a href="{{ route('profile.edit', Auth::user()->profile) }}">
                <img class="mx-auto rounded-circle" src={{ Auth::user()->profile->image }} alt="">
                <div class="text"><i class="far fa-edit"></i> <br> Modifica <br> profilo</div>
            </a>
            </div>
        </div>
    </div>
    <hr class='styled-hr'>
    <div class="row mb-3">
        <div class="col-12 text-center">
            <a href="{{ route('meeting.create') }}" class="btn btn-side btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Nuovo appuntamento" ><i class="fas fa-plus"></i> Appuntamento</a>
        </div>
    </div>
    <hr class='styled-hr'>
    @if (Auth::user()->auth_level == 'Admin' || Auth::user()->auth_level == 'Operator')
    {{-- <div class="row mb-2">
        <div class="col-6 d-flex justify-content-start">
            <h5>Info</h5>
        </div>
        <div class="col-3" style='padding:0px'>
            <a href="{{route('info.index')}}" class="btn btn-side btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Vedi"><i class="far fa-eye"></i></a>
        </div>
        <div class="col-3" style='padding:0px'>
            <a href="{{route('info.create')}}" class="btn btn-side btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Nuova" ><i class="fas fa-plus"></i></a>
        </div>
    </div> --}}
 <hr class='styled-hr'>
    {{-- <div class="row mb-2">
        <div class="col-6 d-flex justify-content-start">
            <h5>Offerte</h5>
        </div>
        <div class="col-3" style='padding:0px'>
            <a href="{{route('offer.index')}}" class="btn btn-side btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Vedi" ><i class="far fa-eye"></i></a>
        </div>
        <div class="col-3" style='padding:0px'>
            <a href="{{route('offer.create')}}" class="btn btn-side btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Nuova" ><i class="fas fa-plus"></i></a>
        </div>
    </div> --}}
    <hr class='styled-hr'>
    {{-- <div class="row mb-2">
        <div class="col-6 d-flex justify-content-start">
            <h5>News</h5>
        </div>
        <div class="col-3" style='padding:0px'>
            <a href="{{route('news.index')}}" class="btn btn-side btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Vedi"><i class="far fa-eye"></i></a>
        </div>
        <div class="col-3" style='padding:0px'>
            <a href="{{route('news.create')}}" class="btn btn-side btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Nuova"><i class="fas fa-plus"></i></a>
        </div>
    </div> --}}
    @endif
</div>
