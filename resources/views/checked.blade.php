@extends('layouts.app')

@section('content')

<div class="container text-center">

  <h1 class="text-center text-success text-uppercase text-dark animateuse mb-5"> Quizz</h1>
  
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

</div>

@endsection