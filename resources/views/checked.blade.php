@extends('layouts.app')

@section('content')

<div class="container">

  <h1 class="text-center text-success text-uppercase text-dark animateuse mb-5">Quizz</h1>
  
  <table class="table text-center table-bordered table-hover">

    <thead class="thead-dark">
      <tr>

        <th colspan="2" scope="col">
          <h4>Résultat</h4>
        </th>

      </tr>
    </thead>

    <tbody>

      <tr>
        <td>Questions tentées</td>
        <td>Vous avez répondu à {{ $answerNb }} questions.</td>
      </tr>

      <tr>
        <td>Total score</td>
        <td colspan="2">Votre score est de {{ $Resultans }}.</td>
      </tr>

    </tbody>
  </table>

  @foreach($questions as $i => $question)

    <div class="card mb-3">
        <div class="card-header {{ ($question->ReponseID == $answers[$i+1]) ? 'bg-success' : 'bg-danger' }}"> {{$question->Question}} </div>
        <div class="card-body d-flex flex-column">

          @foreach($question->reponse as $reponse)
              <div class="form-check">
                <input class="form-check-input" type="radio" id="radio{{ $reponse->ReponseID }}" value="{{$reponse->ReponseID}}" {{ ($reponse->ReponseID == $answers[$i+1]) ? 'checked' : '' }} disabled>
                <label class="form-check-label {{ ($question->ReponseID == $reponse->ReponseID) ? 'text-success' : '' }}" for="radio{{ $reponse->ReponseID }}">
                  {{$reponse->reponse}}
                </label>
              </div>
          @endforeach

        </div>
    </div>

  @endforeach

</div>

@endsection