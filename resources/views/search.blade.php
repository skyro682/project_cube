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
                            <option value=0>Dernier créé d'abord</option>
                            <option value=1>Premier créé d'abord</option>
                            <option value=2>Premier modifié d'abord</option>
                            <option value=3>Dernier modifié d'abord</option>
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
                        <div class="card-header">{{ $postResult['name'] }}</div>
                        <div class="card-body">
                            <p class ="card-text">{{ $postResult['content'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

@endsection
