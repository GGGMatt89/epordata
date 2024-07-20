@extends ('layouts.db')

@section('main_content_page')
    <div class='row'>
        <div class='col-12'>
            <h3 class='section_title'>Lista profili utenti</h3>
            <hr class='styled-hr'>
        </div>
    </div>
    <div class='table-responsive' id='profiles_table'>
        <table class="table table-hover align-middle">
            <thead>
            <tr>
            <th scope="col">Cognome</th>
            <th scope="col">Nome</th>
            <th scope="col">Cellulare</th>
            <th scope="col">Area</th>
            <th scope="col"> </th>
            <th scope="col"> </th>
            @if(Auth::user()->auth_level == 'Admin')
                <th scope="col"> </th>
            @endif
            </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                    <tr>
                    <th scope="row">{{ $profile -> last_name }}</th>
                    <td>{{ $profile -> first_name}}</td>
                    <td>{{ $profile -> mobile_phone }}</td>
                    <td>{{ $profile -> area }}</td>
                    <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('profile.show', $profile->id ) }}"><i class="far fa-eye"></i></a></td>
                    <td><a class = "btn btn-dark-blue-out  btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('profile.edit', $profile->id ) }}"><i class="far fa-edit"></i></a></td>
                    @if(Auth::user()->auth_level == 'Admin')
                        <td><a class = "btn btn-dark-blue-out  btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica utente" href = "{{route ('user.edit', $profile->user->id ) }}"><i class="fas fa-user-cog"></i></a></td>
                    @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
