@extends('layouts.app')

@section('content')

@foreach ($ressources as $ressource)
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
            <a class="text-secondary" href="{{ route('ressources.update', ['id' => $ressource->id]) }}">{{ Auth::user()->id == $ressource->users_id ? 'modifier' : ''}}</a> | <a class="text-danger" data-toggle="modal" data-target="#deleteResModal{{$ressource->id}}">supprimer</a>

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
<hr>
@endforeach


<!-- Onglet-->
<div class="" id="">
    <div class="col-lg-4"> </div>
    <div class="container col-lg-4 text-center mt-4">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 text-center">
                {{ $ressources->links() }}
            </div>
        </div>

    </div>
</div>

@endsection