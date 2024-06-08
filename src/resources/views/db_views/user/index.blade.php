@extends ('layouts.db')

@section ('main_content_page')
<div class='row'>
        <div class='col-12'>
            <h3 class='section_title'>Lista utenti registrati</h3>
            <hr class='styled-hr'>
        </div>
    </div>
                <div class='row'>
                    <div class='col-2'>
                        <a role="button" class="btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi utente" href="{{ route('register') }}"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class='table-responsive' id='users_table' style='padding-top: 20px;'>
                    <table class="table table-hover">
                    <thead>
                        <tr class="bg-table-header">
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Ruolo</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user -> id }}</th>
                            <td>{{ $user -> name }}</td>
                            <td>{{ $user -> auth_level }}</td>
                            <td>{{ $user -> email }}</td>
                            <td><a class = "btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('user.edit', $user->id )}}"><i class="far fa-edit"></i></a></td>
                            <td><form class='delete_form' id='{{$user->id}}_delete_form' action="{{ route('user.delete', $user->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$user->id}})'><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
@endsection
