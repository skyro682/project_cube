@extends('layouts.app')

@section('content')

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

        <!-- Section Content-->
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 text-center">
                <p class="lead"> {{ $ressource->content }} </p>
            </div>
        </div>

        <!-- update or delete Section-->
        <div class="text-center  mt-4">
            @auth
            @if(Auth::user()->id == $ressource->users_id || Auth::user()->grade_id > 1)
            <a href="{{ route('updateRes', ['id' => $ressource->id]) }}">{{ Auth::user()->id == $ressource->users_id ? 'modifier' : ''}}</a> | <a data-toggle="modal" data-target="#deleteResModal" >supprimer</a>
            
            <div class="modal fade" id="deleteResModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body d-flex">
                            <p class="mb-0">Etes vous sûr de vouloir supprimer cette ressource ?</p>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
                            <button onclick="location.href='{{ route('deleteRessource', ['id' => $ressource->id]) }}'" class="btn btn-danger btn-sm ml-1 py-auto">Supprimer</button>
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

@endsection