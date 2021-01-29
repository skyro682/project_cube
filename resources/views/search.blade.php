@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{ route('search') }}" method="get">
                    <div class="form-group">
                        <label for="query">Rechercher un post</label>
                        <input type="text" class="form-control" id="query" name="query"  placeholder="Par nom"
                        @if(isset($_GET['query']))
                            value="{{ $_GET['query'] }}"
                        @endif>
                        <input type="text" class="form-control" id="query" name="contentQuery"  placeholder="Par contenu"
                               @if(isset($_GET['contentQuery']))
                               value="{{ $_GET['contentQuery'] }}"
                            @endif>
                        <br>
                        <label for="categorySelect">Catégorie</label>
                        <select class="form-control" id="categorySelect" name="category">
                            <option value="all">Toutes</option>
                            @foreach($categoriesList as $category)
                                @if(isset($category['id']))
                                    <option value={{ $category['id'] }}>{{ $category['name'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <label for="regionSelect">Région</label>
                        <select class="form-control" id="regionSelect" name="region">
                            <option value="all">Toutes</option>
                            @foreach($regionsList as $region)
                                @if(isset($region['id']))
                                    <option value={{ $region['id'] }}>{{ $region['name'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <label for="orderSelect">Affichage des posts</label>
                        <select class="form-control" id="orderSelect" name="order">
                            <option value=0>Derniers créés d'abord</option>
                            <option value=1>Premiers créés d'abord</option>
                            <option value=2>Premiers modifiés d'abord</option>
                            <option value=3>Derniers modifiés d'abord</option>
                            <option value=2>Les plus vus d'abord</option>
                            <option value=3>Les moins vus d'abord</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($searchResults != NULL)
        @foreach($searchResults as $postResult)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header">{{ $postResult->name }}</div>
                        <div class="card-body">
                            <p class ="card-text">{{ $postResult->content }}</p>
                            <button type="button" class="btn btn-info" onclick="location.href='{{ route('viewRes', ['id' => $postResult->id]) }}'">Voir plus...</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

@endsection
