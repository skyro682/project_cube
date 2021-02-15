@extends('layouts.app')

@section('content')

<!--- Debut body --->
<div class="container col-10 mt-5 mb-5">

    <h1 class="text-center text-uppercase mb-5">Page Statistique</h1>

    <div class="col-lg-9-center">
        <h3 class="text-center" id="wip">Work in progress</h3>
        <div class="row">
            <div id="chart_categorie"></div>
            <div id="chart_region"></div>
            <div id="chart_users_nbr_res"></div>
        </div>

    </div>
    <br>


</div>
<!--- Fin body --->





<!--- google charts --->

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
                    //echo "'", $categorie->Category_id , "'";
                    foreach ($categories_name as $categorie_name)
                    {
                        if ($categorie_name->id == $categorie->Category_id)
                        {
                            echo  "'", $categorie_name->name , "'";
                        }
                    }
                    echo "," , $categorie->total , "]" ; 
                }
            ?>
            
        ]);
        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Les catégories les plus utilisées.',
            'width': 550,
            'height': 400
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
                    //echo "'", $region->Zone->name , "'";
                    foreach ($regions_name as $region_name)
                    {
                        if ($region_name->id == $region->Zone_id)
                        {
                            echo  "'", $region_name->name , "'";
                        }
                    }
                    echo "," , $region->total , "]" ; 
                }
            ?>
            
        ]);
        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'Les régions les plus activent.',
            'width': 550,
            'height': 400
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
            'title': 'Les utilisateurs les plus actifs.',
            'width': 550,
            'height': 400
        };

        // Display the chart inside the <div> element with id="chart_categorie"
        var chart = new google.visualization.PieChart(document.getElementById('chart_users_nbr_res'));
        chart.draw(data, options);
    }
</script>

@endsection