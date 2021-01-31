@extends('layouts.app')

@section('content')

<div class="container col-10 mt-5 mb-5">

    <h1 class="text-center text-uppercase mb-5">Page d'aide</h1>

    <div class="col-lg-8">
        <h3 class="" id="Accessibilité">1 - Accessibilité</h3>
        <p>
            Dans sa version actuelle, le site ne dispose pas de la possibilité d'echanger avec d'autre membre du site<br>
            Plusieurs sont actuellement à l’étude.<br>
        </p>
        <p>
            <strong>Technologies utilisées sur le site</strong><br>
            LARAVEL, HTML, CSS, JS, PHP.<br>
            PhpMyAdmin<br>
        </p>
    </div>
    <br>

    <div class="col-lg-8">
        <h3 class="" id="Objectif">2 - Objectif de notre site internet</h3>
        <p>
            Les objectifs sont multiples. Les utilisateurs ont à leurs dispositions différentes ressources.<br>
            Ces ressources on pour but d'aider ou d'informer les autres utilisateurs.<br>
            Le site dispose d'une recherche simple et avancée. (Catégories, types de relations concernées, types de ressources, etc.)<br>
            Les utilisateurs connectés ont la possibilité de créer, modifier et supprimer leurs contenus<br>
            Ceux ci ne peuvent laisser des commentaires.<br>
            Afin de réaliser ces différentes actions, l'utilisateur doit s'inscrire.<br>
        </p>
    </div>
    <br>
    Nous vous invitons à <a href="{{ route('contact') }}" class="spip_in">faire remonter toute anomalie</a>, merci.</p>
</div>
@endsection