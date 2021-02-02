@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('search') }}" method="get">
                    <div class="input-group">

                        <input type="text" class="form-control mr-1" id="query" name="query"  placeholder="Rechercher"
                        @if(isset($_GET['query']))
                            value="{{ $_GET['query'] }}"
                        @endif>

                        <br>
                        <button type="submit" class="btn btn-info mr-1">Rechercher</button>
                        <a class="btn btn-info" href="{{ route('advancedSearch') }}" role="button">Recherche Avancée</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($searchResults != NULL)

        <div class="container col-10 mt-5 mb-5">

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Date ajout</th>
                        <th scope="col">Titre ressource</th>
                        <th scope="col">Nom utilisateur</th>
                        <th scope="col">Date création ressource</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($searchResults as $favoriteKey => $favorite)

                        <tr>

                            <th scope="row">{{ $favoriteKey+1 }}</th>
                            <td><i onclick="location.href='{{ route('viewRes', ['id' => $favorite->id]) }}'" class="btn btn-sm btn-outline-info bi bi-search"></i></td>
                            <td>{{ date('d/m/Y', strtotime($favorite->created_at)) }}</td>
                            <td>{{ $favorite->name}}</td>
                            <td>{{ $favorite->Users->username }}</td>
                            <td>{{ date('d/m/Y', strtotime($favorite->created_at)) }}</td>
                            <td><i onclick="location.href='{{ route('favorite.add_or_delete', ['id' => $favorite->id, 'add' => 1, 'view' => '2']) }}'" class="btn btn-sm btn-outline-danger bi bi-trash"></i></td>

                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
