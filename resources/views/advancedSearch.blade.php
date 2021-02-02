@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{ route('advancedSearch') }}" method="get">
                    <div class="form-group">
                        <label for="query">Rechercher une ressource</label>
                        <input type="text" class="form-control" id="query" name="query"  placeholder="Par titre"
                        @if(isset($_GET['query']))
                            value="{{ $_GET['query'] }}"
                        @endif>
                        <input type="text" class="form-control" id="query" name="contentQuery"  placeholder="Par contenu"
                               @if(isset($_GET['contentQuery']))
                               value="{{ $_GET['contentQuery'] }}"
                            @endif>
                        <br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Région</label>
                            </div>
                            <select name="region" class="custom-select" id="inputGroupSelect01">
                                <option value="{{ (isset($ressource)) ? $ressource->region->id : '' }}">{{ (isset($ressource)) ? $ressource->region->name : 'Choisir une option...' }}</option>
                                @foreach ($regionsList as $region)

                                    <option value="{{ $region->id }}">{{ $region->name }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Catégorie</label>
                            </div>
                            <select name="category" class="custom-select" id="inputGroupSelect01">
                                <option value="{{ (isset($ressource)) ? $ressource->$category->id : '' }}">{{ (isset($ressource)) ? $ressource->$category->name : 'Choisir une option...' }}</option>
                                @foreach ($categoriesList as $category)

                                    <option value="{{ $category->id }}">{{ $category->name }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Ordre</label>
                            </div>
                            <select name="order" class="custom-select" id="inputGroupSelect01">
                                <option value=0>{{ "Derniers créés d'abord" }}</option>
                                <option value=1>{{ "Premiers créés d'abord" }}</option>
                                <option value=2>{{ "Premiers modifiés d'abord" }}</option>
                                <option value=3>{{ "Derniers modifiés d'abord" }}</option>
                                <option value=4>{{ "Les plus vus d'abord" }}</option>
                                <option value=5>{{ "Les moins vus d'abord" }}</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-info">Rechercher</button>
                        <a class="btn btn-info" href="{{ route('search') }}" role="button">Recherche Simple</a>
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
