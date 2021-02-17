@extends('layouts.app')

@section('content')

<!--- ---- Debut body ---- --->
<div class="container col-10 mt-5 mb-5">

    <h1 class="text-center text-uppercase mb-5">Page Statistique</h1>

    <div class="col-lg-9-center">
        <div class="row justify-content-md-center mt-3 mb-3">
            <div id="chart_categorie"></div>
            <div id="chart_region"></div>
            <div id="chart_users_nbr_res"></div>
        </div>
        <div class="row justify-content-md-center mt-3 mb-3">
            <div id="chart_users_nbr_view"></div>
            <div id="comments"></div>
            <div id="commentsUsers"></div>
        </div>

    </div>
    <br>


</div>
<!--- ---- Fin body ---- --->





<!--- ---- google charts ---- --->

<!--- Categorie --->
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Catégories', 'Par nombre d\'utilisation']
            <?php  
                foreach ($categories as $categorie)
                {
                    echo ",\n";
                    echo "["; 
                    echo "'", $categorie->Category->name, "'";
                    echo "," , $categorie->total , "]" ; 
                }
            ?>
            
        ]);
        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Les catégories les plus utilisées.',
            'width': 480,
            'height': 349
        };

        // Display the chart inside the <div> element with id="chart_categorie"
        var chart = new google.visualization.PieChart(document.getElementById('chart_categorie'));
        chart.draw(data, options);
    }
</script>

<!--- Region --->
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Régions', 'Par nombre d\'utilisation']
            <?php  
                foreach ($regions as $region)
                {
                    echo ",\n";
                    echo "["; 
                    echo "'", $region->Zone->name , "'";
                    echo "," , $region->total , "]" ; 
                }
            ?>
            
        ]);
        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Les régions les plus activent.',
            'width': 480,
            'height': 349
        };

        // Display the chart inside the <div> element with id="chart_categorie"
        var chart = new google.visualization.PieChart(document.getElementById('chart_region'));
        chart.draw(data, options);
    }
</script>

<!--- Users nbr postes --->
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Nombres de postes', 'Par utilisateur']
            <?php  
                foreach ($utilisateursResAdd as $utilisateurResAdd)
                {
                    echo ",\n";
                    echo "["; 
                    echo "'", $utilisateurResAdd->Users->username, "'";
                    echo "," , $utilisateurResAdd->total , "]" ; 
                }
            ?>
            
        ]);
        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Les utilisateurs les plus actifs. (Ressources)',
            'width': 480,
            'height': 349
        };

        // Display the chart inside the <div> element with id="chart_categorie"
        var chart = new google.visualization.PieChart(document.getElementById('chart_users_nbr_res'));
        chart.draw(data, options);
    }
</script>

<!--- Ressources les plus consulté --->
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Nombres de vues', 'Par ressource']
            <?php  
                foreach ($utilisateursCount_view as $utilisateurCount_view)
                {
                    echo ",\n";
                    echo "["; 
                    echo "'", $utilisateurCount_view->id, " | " , $utilisateurCount_view->name, "'";
                    echo "," , $utilisateurCount_view->count_view , "]" ; 
                }
            ?>
            
        ]);
        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Les ressources les plus consultées.',
            'width': 480,
            'height': 349
        };

        // Display the chart inside the <div> element with id="chart_categorie"
        var chart = new google.visualization.PieChart(document.getElementById('chart_users_nbr_view'));
        chart.draw(data, options);
    }
</script>

<!--- Ressources les plus commentés --->
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Nombres de commentaires', 'Par ressource']
            <?php  
                foreach ($comments as $comment)
                {
                    echo ",\n";
                    echo "["; 
                    echo "'", $comment->ressources_id, " | ", $comment->ressources->name, "'";
                    echo ",", $comment->total , "]" ; 
                }
            ?>
            
        ]);
        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Les ressources les plus commentées.',
            'width': 480,
            'height': 349
        };

        // Display the chart inside the <div> element with id="chart_categorie"
        var chart = new google.visualization.PieChart(document.getElementById('comments'));
        chart.draw(data, options);
    }
</script>

<!--- Users qui commente le plus --->
<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Nombres de commentaires', 'Par utilisateur']
            <?php  
                foreach ($commentsUsers as $commentUser)
                {
                    echo ",\n";
                    echo "[";
                    echo "'", $commentUser->Users->username, "'";
                    echo ",", $commentUser->total , "]" ; 
                }
            ?>
            
        ]);
        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Les utilisateurs les plus réactifs. (Commentaires)',
            'width': 480,
            'height': 349
        };

        // Display the chart inside the <div> element with id="chart_categorie"
        var chart = new google.visualization.PieChart(document.getElementById('commentsUsers'));
        chart.draw(data, options);
    }
</script>
@endsection