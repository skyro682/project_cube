@extends('layouts.app')

@section('content')

<div class="" id="">
    <div class="col-lg-4"> </div>
    <div class="container col-lg-4">
        <br>
        @auth
        <!-- add favorite-->
        <div class="row">
            <div class="col d-flex justify-content-center">
                <i class="mr-2 {{(count($favoris) > 0) ? 'text-warning bi bi-star-fill' : 'bi bi-star' }}"> </i>
                <a class="mt-1 {{(count($favoris) > 0) ? 'text-danger' : 'text-secondary' }}" href="{{ route('favorite.add_or_delete', ['id' => $ressource->id, 'add' => count($favoris), 'view' => '1']) }}">{{(count($favoris) > 0) ? 'Supprimer des favoris' : 'Ajouter au favoris' }}</a>
            </div>
        </div>
        <br>
        @endauth

        <!-- Section Heading-->
        <h2 class="text-center text-uppercase">{{ $ressource->name }}</h2>
        <h5 class="text-center text-uppercase">{{ $ressource->Zone->name }}</h5>
        <h5 class="text-center text-uppercase">{{ $ressource->Category->name }}</h5>

        <h6 class="text-center text-uppercase">Post de : {{ $ressource->Users->username ?? 'Utilisateur Supprimer' }}</h6>
        <h6 class="text-center text-uppercase">écrit le : {{ date('d/m/Y', strtotime($ressource->created_at)) }} à {{ date('h:i:s', strtotime($ressource->created_at)) }}</h6>
        <h6 class="text-center text-uppercase">Mis à jour le : {{ date('d/m/Y', strtotime($ressource->updated_at)) }} à {{ date('h:i:s', strtotime($ressource->updated_at)) }}</h6>

        <!-- Section Content-->
        <div class="row align-content-center">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 text-center">
                <p class="lead"> {{ $ressource->content }} </p>

                <!-- Section File-->
                @if(file_exists($ressource->file_path))
                @if($fileIsImage == TRUE)
                <img class="fit-picture" src="{{ asset($ressource->file_path) }}" alt="image">
                @else
                <h6 class="text-center text-uppercase">Fichier associé</h6>
                <a class="text-center" href="{{asset($ressource->file_path)}}" target="_blank">{{ $fileName }}</a>
                @endif
                @endif
            </div>
        </div>
        <br>

        <br>

        <!-- update or delete Section-->
        <div class="text-center  mt-4">
            @auth
            @if(Auth::user()->id == $ressource->users_id || Auth::user()->grade_id > 1)
            <a class="text-secondary" href="{{ route('ressources.update', ['id' => $ressource->id]) }}">{{ Auth::user()->id == $ressource->users_id ? 'modifier' : ''}}</a> | <a class="text-danger" data-toggle="modal" data-target="#deleteResModal">supprimer</a>

            <div class="modal fade" id="deleteResModal" tabindex="-1" aria-hidden="true">
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
<!-- commentaire Section-->
<section class="page-section" id="commentaire">
    <h5 class="text-center text-uppercase">Commentaire</h5>

    @auth
    <!-- ajout commentaire Section-->
    <section class="page-section" id="add_commentaire">
        <div class="col-lg-4"> </div>
        <div class="container form-group col-lg-4 ">

            @if(isset($edit) && isset($commentEdit) && $edit == 1)
            <form action="{{route('ressources.updateComment', ['id' => $ressource->id, 'id_com' => $commentEdit->id])}}" method="POST">
                @else
                <form action="{{route('ressources.addComment', ['id' => $ressource->id])}}" method="POST">
                    @endif
                    @csrf
                    <label for="comment">Votre commentaire:</label>
                    <textarea class="form-control" rows="5" id="comment" name="comment">{{ (isset($edit) && isset($commentEdit) && $edit == 1) ? $commentEdit->content : ''}}</textarea>
                    <div class="float-right mt-2">
                        @if(isset($edit) && isset($commentEdit) && $edit == 1)
                        <button type="submit" class="btn btn-info">Modifier</button>
                        @else
                        <button type="submit" class="btn btn-info">Ajouter</button>
                        @endif
                    </div>
                </form>
                <div class="float-left mt-2">
                    @if(isset($edit) && isset($commentEdit) && $edit == 1)
                    <button type="submit" class="btn btn-info" onclick="location.href='{{route('viewRes', ['id' => $ressource->id]) }}'">Annuler</button>
                    @endif
                </div>

        </div>
    </section>
    @endauth
    <br>
    <br>

    <!-- Foreach -->
    <div class="col-lg-4"> </div>
    <div class="container col-lg-4 bg-comment">
        @if (count($comments) == 0)
        <br>
        <p class="text-muted">Aucun commentaire</p>
        <hr>
        @endif
        @foreach ($comments as $comment)
        <br>
        <!-- section 1 Section Heading-->
        <p>{{ $comment->content }} | {{ $comment->created_at }} | {{ $comment->users->username }}</p> <!-- com 1-->
        @auth
        @if(Auth::user()->id == $comment->users_id || Auth::user()->grade_id > 1)
        <a class="text-secondary" href="{{ route('ressources.viewUpdateComment', ['id' => $ressource->id, 'id_com' => $comment->id]) }}">{{ Auth::user()->id == $comment->users_id ? 'modifier' : ''}}</a> | <a class="text-danger" style="cursor:  pointer;" data-toggle="modal" data-target="#deleteComModal{{$comment->id}}" onclick="">supprimer</a>

        <div class="modal fade" id="deleteComModal{{$comment->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body d-flex">
                        <p class="mb-0">Etes vous sûr de vouloir supprimer ce commentaire ?</p>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
                        <button onclick="location.href='{{ route('ressources.deleteComment', ['id' => $ressource->id, 'id_com' => $comment->id]) }}'" class="btn btn-danger btn-sm ml-1 py-auto">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endauth
        <hr>
        @endforeach
        <!-- Onglet-->
        <div class="" id="">
            <div class="col-lg-4"> </div>
            <div class="container col-lg-4 text-center mt-4">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-center">
                        {{ $comments->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<br>
<hr>


@endsection