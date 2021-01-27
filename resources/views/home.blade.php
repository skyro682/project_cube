@extends('layouts.app')

@section('content')

<?php $i = 0; ?>
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

        <!-- Section Content-->
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 text-center">
                <p class="lead"> </p>
            </div>
        </div>
        <!-- more Section-->
        <div class="text-center mt-4">
            <button type="button" class="btn btn-info" onclick="location.href=''">Voir plus...</button>
        </div>
        <!-- update or delete Section-->
        <div class="text-center mt-4">
            <a onclick="location.href=''">modifier</a> | <a onclick="location.href=''">supprimer</a>

        </div>
        <br>
    </div>
</div>
<?php $i++; ?>
@endforeach

@endsection