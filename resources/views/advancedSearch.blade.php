@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{ route('advancedSearch') }}" method="get">
                    <div class="form-group">
                        <label for="query">Rechercher une ressource</label>
                        <input type="text" class="form-control" id="query" name="query"  placeholder="Par nom"
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
                                <label class="input-group-text" for="inputGroupSelect01">Catégorie</label>
                            </div>
                            <select name="zone_id" class="custom-select" id="inputGroupSelect01">
                                <option value="{{ (isset($ressource)) ? $ressource->$category->id : '' }}">{{ (isset($ressource)) ? $ressource->$category->name : 'Choisir une option...' }}</option>
                                @foreach ($categoriesList as $category)

                                    <option value="{{ $category->id }}">{{ $category->name }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Région</label>
                            </div>
                            <select name="zone_id" class="custom-select" id="inputGroupSelect01">
                                <option value="{{ (isset($ressource)) ? $ressource->region->id : '' }}">{{ (isset($ressource)) ? $ressource->region->name : 'Choisir une option...' }}</option>
                                @foreach ($regionsList as $region)

                                    <option value="{{ $region->id }}">{{ $region->name }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Ordre</label>
                            </div>
                            <select name="zone_id" class="custom-select" id="inputGroupSelect01">
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
        @foreach($searchResults as $ressource)
        <!--
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header">{{ $ressource->name }}</div>
                        <div class="card-body">
                            <p class ="card-text">{{ $ressource->content }}</p>
                            <button type="button" class="btn btn-info" onclick="location.href='{{ route('viewRes', ['id' => $ressource->id]) }}'">Voir plus...</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
        <div class="" id="">
            <div class="col-lg-4"> </div>
            <div class="container col-lg-4">
                <br>
                <!-- Section Heading-->
                <h2 class="text-center text-uppercase">{{ $ressource->name }}</h2>
                <h5 class="text-center text-uppercase">{{ $ressource->Zone->name }}</h5>
                <h5 class="text-center text-uppercase">{{ $ressource->Category->name }}</h5>

                <h6 class="text-center text-uppercase">Post de : {{ $ressource->Users->username }}</h6>
                <h6 class="text-center text-uppercase">écrit le : {{ $ressource->created_at }}</h6>
                <h6 class="text-center text-uppercase">Mise à jour le : {{ $ressource->updated_at }}</h6>

                <!-- more Section-->
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-info" onclick="location.href='{{ route('viewRes', ['id' => $ressource->id]) }}'">Voir plus...</button>
                </div>
                <!-- update or delete Section-->
                <div class="text-center  mt-4">
                    @auth
                        @if(Auth::user()->id == $ressource->users_id || Auth::user()->grade_id > 1)
                            <a href="{{ route('ressources.update', ['id' => $ressource->id]) }}">{{ Auth::user()->id == $ressource->users_id ? 'modifier' : ''}}</a> | <a data-toggle="modal" data-target="#deleteResModal{{$ressource->id}}">supprimer</a>

                            <div class="modal fade" id="deleteResModal{{$ressource->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body d-flex">
                                            <p class="mb-0">Etes vous sûr de vouloir supprimer cette ressource ?</p>
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
                                            <button onclick="location.href='{{ route('ressources.delete', ['id' => $ressource->id]) }}'" class="btn btn-danger btn-sm ml-1 py-auto">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
                <br>
            </div>
        </div>
        @endforeach
    @endif

@endsection
