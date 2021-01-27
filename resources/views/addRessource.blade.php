@extends('layouts.app')

@section('content')

<br>
<!-- body Section-->
<div class="page-section" id="1">
    <div class="col-lg-4"> </div>
    @if(!isset($ressource))
    <form method="POST" action="{{ route('ressources.add')}}" class="container col-lg-4">
        @else
        <form method="POST" action="{{ route('ressources.update', ['id' => $ressource->id])}}" class="container col-lg-4">
            @endif
            @csrf
            <br>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="name_add_post">Titre</span>
                </div>
                <input  name="name" type="text" class="form-control" placeholder="Exemple : 'Aide pour les personnes sans abris'" aria-label="titre" aria-describedby="name" value="{{ (isset($ressource)) ? $ressource->name : '' }}">
            </div>
            <!-- Zone -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Région</label>
                </div>
                <select name="zone_id" class="custom-select" id="inputGroupSelect01">
                    <option value="{{ (isset($ressource)) ? $ressource->zone->id : '' }}">{{ (isset($ressource)) ? $ressource->zone->name : 'Choisir une option...' }}</option> 
                    @foreach ($zones as $zone)

                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>

                    @endforeach
                </select>
            </div>
            <!-- Category -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Catégorie</label>
                </div>
                <select name="category_id" class="custom-select" id="inputGroupSelect01">
                   <option value="{{ (isset($ressource)) ? $ressource->category->id : '' }}">{{ (isset($ressource)) ? $ressource->category->name : 'Choisir une option...' }}</option> 
                    @foreach ($categories as $category)

                    <option value="{{ $category->id  }}">{{ $category->name }}</option>

                    @endforeach
                </select>
            </div>
            <!-- content -->
            <label for="comment">Details :</label>
            <textarea class="form-control" rows="5" id="comment" name="content">{{ (isset($ressource)) ? $ressource->content : '' }}</textarea>
            <br>
            <!-- file -->
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choisissez un fichier...</label>
            </div>
            <br>
            <br>
            <div class=float-right>
                <button type="submit" class="btn btn-primary"> {{ (isset($ressource)) ? 'Modifier' : 'Poster' }} </button>
            </div>
        </form>
</div>
<div style="padding: 1rem 0;"> </div>

<!-- Pour récuperer le lien du fichier -->
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

@endsection