<?php
//Adatokat jelenít meg a $_SESSION értékek alapján.
?>

<hr style="filter:alpha(opacity=100,finishopacity=5,style=1);height:10px" color=blue>

<div class="d-flex justify-content-center align-items-center flex-column mb-5 mt-3 container">
    
    <div class="d-flex align-items-center justify-content-center col-md-5">
		<div class="text-center">
            <?php
                if(empty($_SESSION['datum'])){
                    echo'<h1 class="display-7 fw-bold">A kitöltés sikeres!</h1>';
                }else{
                    echo'<h1 class="display-7 fw-bold">'.$_SESSION['datum'].'</h1>';
                }
            
            ?>

			
			<p class="fs-3"> A maga szédioxid kibocsátása átlagosan <span class="text-warning bg-dark"><?php echo $_SESSION["osszes_pont"]?>tonna Co2/év</span></p>
		</div>
        
	</div>

    <hr align=center width=50%>

    <div><!--Beállítások a pie-chart-hoz-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([

            <?php
            $etel = floatval($_SESSION["etel_pont"]);
            $otthon = floatval($_SESSION["otthon_pont"]);
            $kozlekedes = floatval($_SESSION["kozlekedes_pont"]);
            $vasarlas = floatval($_SESSION["vasarlas_pont"]);
            
            
            echo'
            ["Task", "Hours per Day"],
            ["Étel",     '.$etel.'],
            ["Otthon",      '.$otthon.'],
            ["Közlekedés", '.$kozlekedes.'],
            ["Vásárlás",    '.$vasarlas.']
            
            ';
            ?>
            
            ]);

            const options = {
            title: 'Széndioxid termelés egy évre nézve',
            backgroundColor: '#01e08e',
            chartArea: { backgroundColor: '#f4f4f4' },
            
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
        </script>
    </div>

    
    <div class="d-flex justify-content-center align-item-center">
        <div class="col-md-2"></div>


        
        <div id="piechart" style="height: 100%; width:100%" class="col-md-8"></div>


        <div class="col-md-2"></div>

    </div>

    




    <hr align=center width=50%>

    <div class ="col-md-2"><!--Beállítások az oszlop-hoz-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            
            
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
            <?php
              
                if(empty($_SESSION["fnev"])){
                    $fnev = "Maga";
                }else{
                    $fnev = strval($_SESSION["fnev"]);
                }
                $ossz = floatval($_SESSION["osszes_pont"]);
                    
                $utvonal = "jsons/orszag_kibocs/orszagos_atlagok.json";
                $json_adat_nyers = file_get_contents($utvonal);
                $json_adat = json_decode(''.$json_adat_nyers.'',true);

                echo'
                ["Element", "tonna Co2/év", { role: "style" } ],
                ["'.$fnev.'", '.$ossz.', "#b87333"],';

                foreach($json_adat as $adat){ 
                    echo '["'.$adat["orszag"].'", '.floatval($adat["atlag"]).', "'.$adat["szin"].'"],';
                
                }
            ?> 
            ]);
            
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            var options = {
                vAxes: {
                    0: { baseline: 0},
                },

                title: "Co2 kibocsátás más országok lakóinak átlagához képest",
                bar: {groupWidth: "95%"},
                
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }
        </script>
        

    </div>

    <div class="d-flex justify-content-center align-item-center">
        <div class="col-md-0"></div>


        <div id="columnchart_values" style="width: 100%; height: 500px" class="col-md-12"></div>


        <div class="col-md-0"></div>

    </div>
    

</div>
