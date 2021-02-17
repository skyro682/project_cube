@extends('layouts.app')

@section('content')

<br>
<!-- body Section-->
<div class="page-section" id="1">
    <div class="col-lg-4"> </div>
    @if(!isset($ressource))
    <form enctype="multipart/form-data" method="POST" action="{{ route('ressources.add')}}" class="container col-lg-4">
        @else
        <form enctype="multipart/form-data" method="POST" action="{{ route('ressources.update', ['id' => $ressource->id])}}" class="container col-lg-4">
            @endif
            @csrf
            <br>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="name_add_post">Titre</span>
                </div>
                <input required name="name" type="text" class="form-control" placeholder="Exemple : 'Aide pour les personnes sans abris'" aria-label="titre" aria-describedby="name" value="{{ (isset($ressource)) ? $ressource->name : '' }}">
            </div>
            <!-- Zone -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Région</label>
                </div>
                <select name="zone_id" class="custom-select" id="inputGroupSelect01">
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
                    @foreach ($categories as $category)

                    <option value="{{ $category->id  }}">{{ $category->name }}</option>

                    @endforeach
                </select>
            </div>
            <!-- content -->
            <label for="comment">Details :</label>
            <textarea required class="form-control" rows="5" id="comment" name="content">{{ (isset($ressource)) ? $ressource->content : '' }}</textarea>
            <br>
            <!-- file -->
            @if(isset($ressource))
                @if(file_exists($ressource->file_path))
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="name_add_post">Source</span>
                        </div>
                        <input name="old_file" value="{{ $ressource->file_path }}" type="text" class="form-control"  aria-label="titre" aria-describedby="name">
                    </div>
                @endif
            @endif
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="file" name="file">
                <label class="custom-file-label" for="file">{{ (isset($ressource)) ? 'Modifier la source' : 'Choisir un fichier' }}</label>
            </div>

            <script>
                // Add the following code if you want the name of the file appear on select
                $(".custom-file-input").on("change", function() {
                    var file = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(file);
                });
            </script>



            <br>
            <br>
            <div class=float-right>
                <button type="submit" class="btn btn-primary"> {{ (isset($ressource)) ? 'Modifier' : 'Poster' }} </button>
            </div>
        </form>
</div>
<div style="padding: 1rem 0;"> </div>
@endsection