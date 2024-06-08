@extends ('layouts.db')

@section('main_content_page')
    <div class='row'>
        <div class='col-12'>
            <h3 class='section_title'>Lista schede news</h3>
            <hr class='styled-hr'>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-2 col-md-1'>
            <a role="button" class="btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Aggiungi" href="{{ route('news.create') }}"><i class="fas fa-plus"></i></a>
        </div>
        {{-- <div class='col-sm-8 col-md-10'>
            <input class="form-control" type="text" placeholder="Cerca...">
        </div>
        <div class='col-sm-2 col-md-1'>
            <button type="button" class="btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Trova" href="#"><i class="fas fa-search"></i></button>
        </div> --}}
    </div>
    <div class='table-responsive' id='news_table' style='padding-top: 20px;'>
        <table class="table table-hover">
        <thead>
            <tr class="bg-table-header">
                <th scope="col">Titolo</th>
                <th scope="col">Estratto</th>
                <th scope="col">Data</th>
                <th scope="col">Immagine</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($news_all as $news)
            <tr class={{ Carbon\Carbon::parse($news -> date) > Carbon\Carbon::now() ? 'future-row' : ''}}>
                <th scope="row">{{ $news -> title }}</th>
                <td>{{ $news -> excerpt}}</td>
                <td>{{ Carbon\Carbon::parse($news -> date) -> toDateString() }}</td>
                <td><img src={{ $news -> image_path }} alt={{ $news -> preview_title }} width="50" height="40"></td>
                <td><a class = "btn btn-dark-blue btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Dettagli" href = "{{route ('news.show', $news -> id ) }}"><i class="far fa-eye"></i></a></td>
                <td><a class = "btn btn-dark-blue-out btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Modifica" href = "{{route ('news.edit', $news -> id ) }}"><i class="far fa-edit"></i></a></td>
                <td><form class='delete_form' id='{{$news->id}}_delete_form' action="{{ route('news.delete', $news->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-primary btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Elimina" type="button" onclick='deleteEntry({{$news->id}})'><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @empty
                <tr> 
                    <th scope="row" colspan="7">Nessuna scheda news</th>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
@endsection 
