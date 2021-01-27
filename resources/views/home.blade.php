@extends('layouts.app')

@section('content')

<div class="" id="">
    <div class="col-lg-4"> </div>
    <div class="container col-lg-4">
        <br>
        <!-- Section Heading-->
        <h2 class="text-center text-uppercase">Name</h2>
        <h5 class="text-center text-uppercase">Zone</h5>
        <h5 class="text-center text-uppercase">category</h5>

        <h6 class="text-center text-uppercase">Post de : </h6>
        <h6 class="text-center text-uppercase">écrit le : </h6>
        <h6 class="text-center text-uppercase">Mise à jour le : </h6>

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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection