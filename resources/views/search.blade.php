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
                        <br>
                        <button type="submit" class="btn btn-info">Rechercher</button>
                        <a class="btn btn-info" href="{{ route('advancedSearch') }}" role="button">Recherche Avancée</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($searchResults != NULL)
        @foreach($searchResults as $ressource)
            <div class="" id="">
                <div class="col-lg-4"> </div>
                <div class="container col-lg-4">
                    <br>
                    <!-- Section Heading-->
                    <h2 class="text-center text-uppercase">{{ $ressource->name }}</h2>
                    <h5 class="text-center text-uppercase">{{ $ressource->Zone->name }}</h5>
                    <h5 class="text-center text-uppercase">{{ $ressource->Category->name }}</h5>

                    <h6 class="text-center text-uppercase">Post de : {{ $ressource->Users->username }}</h6>
                    <h6 class="text-center text-uppercase">écrit le : {{ date('d/m/Y', strtotime($ressource->created_at)) }} à {{ date('h:i:s', strtotime($ressource->created_at)) }}</h6>
                    <h6 class="text-center text-uppercase">Mis à jour le : {{ date('d/m/Y', strtotime($ressource->updated_at)) }} à {{ date('h:i:s', strtotime($ressource->updated_at)) }}</h6>

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
