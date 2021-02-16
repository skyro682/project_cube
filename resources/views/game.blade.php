<?php
   session_start();
   
   if(!isset($_SESSION['username'])){
   	header('location:index.php');
   }
   
   
   $con = mysqli_connect('localhost','root');
  
   	mysqli_select_db($con,'ril_project_1');
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="
         https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
      <style type="text/css">
         .animateuse{
         animation: leelaanimate 0.5s infinite;
         }
         @keyframes leelaanimate{
         0% { color: red }
         10% { color: yellow }
         20%{ color: blue }
         40% {color: green }
         50% { color: pink }
         60% { color: orange }
         80% {  color: black }
         100% {  color: brown }
         }
      </style>
   </head>
   <body>



      <div>
     
            <div class=" col-lg-12 text-center">
               <h3> <a href="#" class="text-uppercase text-warning"> </a> QUIZ TEST </h3>
            </div>
            <br>
            <div class="col-lg-8 d-block m-auto bg-light quizsetting ">
               <div class="card">
                  <p class="card-header text-center" > Vous devez sélctionner qu'une seul réponse par question. <i class="fas fa-thumbs-up"></i>	 </p>
               </div>
               <br>
               <form action="{{route('checked')}}" method="post">
                  <?php
                     for($i=1;$i<6;$i++){
                     $l = 1;
                  
                     $ansid = $i;

                     $sql1 = "SELECT * FROM `question` WHERE `QuestionID` = $i ";
                     	$result1 = mysqli_query($con, $sql1);
                     		if (mysqli_num_rows($result1) > 0) {
                     						while($row1 = mysqli_fetch_assoc($result1)) {
                     	?>				
                  <br>
                  <div class="card">
                     <br>
                     <p class="card-header">  <?php echo $i ." : ". $row1['Question']; ?> </p>
                    
                     <?php
                        $sql = "SELECT * FROM `reponse` WHERE `QuestionID` = $i";
                        	$result = mysqli_query($con, $sql);
                        		if (mysqli_num_rows($result) > 0) {
                        						while($row = mysqli_fetch_assoc($result)) {
                        	?>	
                           
                     <div class="card-block">
                        <input type="radio" name="quizcheck[<?php echo $ansid; ?>]" id="<?php echo $ansid; ?>" value="<?php echo $row['QuestionID']; ?>" > <?php echo $row['reponse']; ?> 
                        <br>
                     </div>
                     <?php
                        
                        } } 
                        $ansid = $ansid + $l;
                        } }}
                        
                     ?>
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


      <?php

      $startlimit  = 0;
      $q =" select ReponseId from reponse";
      $query = mysqli_query($con,$q);
      $lastpage = mysqli_num_rows($query);

      $totalpage = ceil($lastpage / 2);
      ?>
      <div class="m-auto"><br>
         <ul class="pagination">
      <?php
      for($i=1; $i<=$totalpage; $i++){
         ?>
      
     
      
       <?php  
           }
        ?>
        </ul>
      </div>



   </body>
</html>
