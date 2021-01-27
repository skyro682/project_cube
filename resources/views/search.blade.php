@extends('layouts.app')

@section('content')

    @if ($searchResults != NULL)
        @foreach($searchResults as $postResult)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header">{{ $postResult['name'] }}</div>
                        <div class="card-body">
                            <p class ="card-text">Content 1</p>
                            <a href="home" class="btn btn-primary">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

@endsection
