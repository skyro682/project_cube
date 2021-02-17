@extends('layouts.app')

@section('content')


<div class="container text-center">
  <br><br>
  <h1 class="text-center text-success text-uppercase text-dark animateuse"> Quizz</h1>
  <br><br><br><br>
  <table class="table text-center table-bordered table-hover">
    <tr>
      <th colspan="2" class="bg-dark">
        <h1 class="text-white"> Résultat </h1>
      </th>
    </tr>
    <tr>
      <td>
        Questions tentées
      </td>

      <?php
      $counter = 0;
      $Resultans = 0;
      if (isset($_POST['submit'])) {
        if (!empty($_POST['quizcheck'])) {
          // Counting number of checked checkboxes.
          $checked_count = count($_POST['quizcheck']);
          // print_r($_POST);
      ?>

          <td>
            <?php
            echo "Vous avez répondu à " . $checked_count . " questions."; ?>
          </td>


          <?php
          // Loop to store and display values of individual checked checkbox.
          $selected = $_POST['quizcheck'];
          //  dump($selected);

          $i = 1;

          foreach ($questions as $question) {
            // print_r($rows);
            $flag = $question->ReponseID == $selected[$i];

            if ($flag) {
              //  echo "La bonne réponse était " . $question->ReponseID . "<br>";

              $counter++;
              $Resultans++;
              //   echo "Well Done! your " . $counter . " answer is correct <br><br>";
            } else {
              $counter++;
              //  echo "Sorry! your " . $counter . " answer is innncorrect <br><br>";
            }
            $i++;
          }

          ?>



    <tr>
      <td>
        Total score
      </td>
      <td colspan="2">
    <?php
          echo " Votre score est de " . $Resultans . ".";
        } else {
          echo "<b>Please Select Atleast One Option.</b>";
        }
      }

    ?>



      </td>
    </tr>



  </table>


</div>


@endsection