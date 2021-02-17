@extends('layouts.app')

@section('content')



<div>

   <div class=" col-lg-12 text-center">
      <h3> <a href="#" class="text-uppercase text-warning"> </a> QUIZ </h3>
   </div>
   <br>
   <div class="col-lg-8 d-block m-auto bg-light quizsetting ">
      <div class="card">
         <p class="card-header text-center"> Vous devez sélctionner qu'une seul réponse par question. <i class="fas fa-thumbs-up"></i> </p>
      </div>
      <br>
      <form action="{{route('checked')}}" method="post">
         @csrf
         @foreach($questions as $question)
         <br>
         <div class="card">
            <br>
            <p class="card-header"> {{$question->Question}} </p>

            @foreach($question->reponse as $reponse)

            <div class="card-block">
               <input type="radio" name="quizcheck[{{$question->QuestionID}}]" id="{{$question->QuestionID}}" value="{{$reponse->ReponseID}}"> {{$reponse->reponse}}
               <br>
            </div>
            @endforeach

            @endforeach
         </div>

         <br>
         <input type="submit" name="submit" Value="Valider" class="btn btn-success m-auto d-block" /> <br>
      </form>
      <p id="letc"></p>
   </div>
   <br>

</div>
<br>
<footer>
</footer>
</div>

</ul>
</div>
@endsection