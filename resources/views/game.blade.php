@extends('layouts.app')

@section('content')



<div>

   <div class=" col-lg-12 text-center">
      <h3> <a href="#" class="text-uppercase text-warning"> </a> QUIZ </h3>
   </div>
   <br>
   <div class="col-lg-8 d-block m-auto quizsetting ">

      <div class="card mb-3">
         <p class="card-header text-center"> Vous devez sélctionner qu'une seul réponse par question. <i class="fas fa-thumbs-up"></i> </p>
      </div>
      
      <form action="{{route('checked')}}" method="post">

         @csrf
         @foreach($questions as $question)

            <div class="card mb-3">
               <div class="card-header"> {{$question->Question}} </div>
               <div class="card-body d-flex flex-column">

                  @foreach($question->reponse as $reponse)
                     <div>
                        <input required type="radio" name="quizcheck[{{$question->QuestionID}}]" id="{{$question->QuestionID}}" value="{{$reponse->ReponseID}}"> {{$reponse->reponse}}   
                     </div>
                  @endforeach

               </div>
            </div>

         @endforeach

         <input type="submit" name="submit" Value="Valider" class="btn btn-success m-auto d-block" /> <br>
      
      </form>

      <p id="letc"></p>

   </div>

</div>

@endsection