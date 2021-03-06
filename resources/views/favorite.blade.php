@extends('layouts.app')

@section('content')

<div class="container col-10 mt-5 mb-5">

    <h1 class="text-center text-uppercase mb-5">Mes favoris</h1>

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
        @foreach ($favorites as $favoriteKey => $favorite)

            <tr>

                <th scope="row">{{ $favoriteKey+1 }}</th>
                <td><i onclick="location.href='{{ route('viewRes', ['id' => $favorite->ressources->id]) }}'" class="btn btn-sm btn-outline-info bi bi-search"></i></td>
                <td>{{ date('d/m/Y', strtotime($favorite->created_at)) }}</td>
                <td>{{ $favorite->ressources->name}}</td>
                <td>{{ $favorite->ressources->Users->username }}</td>
                <td>{{ date('d/m/Y', strtotime($favorite->ressources->created_at)) }}</td>
                <td><i onclick="location.href='{{ route('favorite.add_or_delete', ['id' => $favorite->ressources->id, 'add' => 1, 'view' => '2']) }}'" class="btn btn-sm btn-outline-danger bi bi-trash"></i></td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>
@endsection
