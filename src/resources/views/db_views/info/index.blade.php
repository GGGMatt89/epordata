@extends ('layouts.db')

@section('main_content_page')
    <div class='row'>
        <div class='col-12'>
            <h3 class='section_title'>Lista schede info</h3>
            <hr class='styled-hr'>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-2 col-md-1'>
            <a role="button" class="btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi" href="{{ route('info.create') }}"><i class="fas fa-plus"></i></a>
        </div>
        {{-- <div class='col-sm-8 col-md-10'>
            <input class="form-control" type="text" placeholder="Cerca...">
        </div>
        <div class='col-sm-2 col-md-1'>
            <button type="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Trova" href="#"><i class="fas fa-search"></i></button>
        </div> --}}
    </div>
    <div class='table-responsive' id='infos_table'>
        <table class="table table-hover align-middle">
        <thead>
            <tr class="bg-table-header">
                <th scope="col">Titolo</th>
                <th scope="col">Estratto</th>
                <th scope="col">Immagine</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($infos as $info)
            <tr>
                <th scope="row">{{ $info -> title }}</th>
                <td>{{ $info -> excerpt}}</td>
                <td><img src={{ $info -> image_path }} alt={{ $info -> preview_title }} width="50" height="40"></td>
                <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('info.show', $info -> id ) }}"><i class="far fa-eye"></i></a></td>
                <td><a class = "btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('info.edit', $info -> id ) }}"><i class="far fa-edit"></i></a></td>
                <td><form class='delete_form' id='{{$info->id}}_delete_form' action="{{ route('info.delete', $info->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$info->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <th scope="row" colspan="6">Nessuna scheda info</th>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
@endsection
