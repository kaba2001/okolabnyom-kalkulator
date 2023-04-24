<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>
<?php

if(empty($_SESSION["id"])){
    header("Location: index.php?page=bej_reg&param=bej");
}else{
    $felhaszn_id = intval($_SESSION["id"]);
    require 'bej_reg_db_kapcs/konfiguracio.php';
    $quer = "SELECT `id`,`kitoltes_datum`,`ert_etel`+ `ert_vasarlas`+ `ert_otthon`+`ert_kozlekedes`AS ossz FROM `kitoltes` WHERE `felhaszn_id`=$felhaszn_id";
    $lekerdezes = mysqli_query($conn, $quer);

    $elozok = array();
    if(mysqli_num_rows($lekerdezes)){
        while ($sor = mysqli_fetch_array($lekerdezes)) {
            array_push($elozok, $sor);
        }
    } 
}
?>

<?php


?>

<div class = "d-flex justify-content-center align-items-center flex-column m-3">
    
    <div class = "d-flex justify-content-center align-items-center flex-column">
        
        <h3 class="mt-5">Tekintse meg előző kitöltéseit, kedves <?php echo $_SESSION['fnev']?>!</h3>

        <span class="mt-2">Válassza ki, milyen régre szeretné visszavezetni a kitöltések előzméyneinek mejelenítését</span>
        
        <!--Itt találhatók a lehetőségek beállításai-->
        <div class="lehetosegek d-flex flex-wrap align-content-between mt-3">

            <script>
                function link_push($opcio){
                    let params = new URLSearchParams(window.location.search);
                    params.set('elozmeny', $opcio);
                    window.location.search = params;
                }

            </script>

            <?php
                $egy_nap = "1 nap";
                $egy_het = "1 hét";
                $egy_honap = "1 hónap";
                $egy_ev = "1 év";
                $osszes = "összes";
                
                function masodperc_napba($seconds) {
                    $vissza = $seconds/60;//perc
                    $vissza = $vissza/60;//óra
                    $vissza = $vissza/24;//nap
                    return $vissza;
                }
            
            ?>

            <?php
            
            if(empty($_GET['elozmeny'])){
                $valasztott = $osszes;
                $nap_szam = 300000;

            }else{
                switch($_GET['elozmeny']){
                    case $egy_nap:
                        $valasztott = $egy_nap;
                        $nap_szam = 1;
                        break;
                    case $egy_het:
                        $valasztott = $egy_het;
                        $nap_szam = 7;
                        break;
                    case $egy_honap:
                        $valasztott = $egy_honap;
                        $nap_szam = 31;
                        break;
                    case $egy_ev:
                        $valasztott = $egy_ev;
                        $nap_szam = 365;
                        break;
                    default:
                        $valasztott = $osszes;
                        $nap_szam = 300000;
                } 
            }
            ?>
            
            <?php

                $lehetosegek = array($egy_nap,$egy_het,$egy_honap,$egy_ev,$osszes);

                foreach($lehetosegek as $egyopcio){


                    $kijelol_oszt = "kijelolt";

                    $jeloletlen_oszt = "jeloletlen";

                    
                    echo'
                    <div class="mt-2 ';echo($valasztott == $egyopcio) ?  $kijelol_oszt: $jeloletlen_oszt;echo'">
                        <label class="flex-fill ev_valto egy_opcio kijelolt" onClick=\'link_push("'.$egyopcio.'")\'>

                            <input type="radio" name="valasz4" id="lehetoseg_3">
                            <div class="valasz p-2 px-4 also_box d-flex justify-content-center border-bal-0">
                                <span>'.$egyopcio.'</span>
                            </div>
                        </label>
                    </div>
                    
                    ';
                }
            ?>
        
        </div>

        <link rel="stylesheet" href="src/evkivalaszto.css">

    </div>
    
        


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Year', 'Co2/év'],
            <?php
                $most = time();
                $talaltok = 0;
                foreach($elozok as $sor){
                    $kitoltes_datum = strval(explode(" ",$sor[1])[0]);
                    if(masodperc_napba($most-strtotime($kitoltes_datum))<$nap_szam){
                        echo '["'.$kitoltes_datum.'",'.intval($sor[2]).'],';  
                        $talaltok++;
                    }  
                }
                if($talaltok == 0){
                    echo '["Nincs elem",0]';
                }
            ?>
            ]);
            var options = {
            
            backgroundColor: '#01e08e',
            chartArea: { backgroundColor: "white" },
            curveType: 'function',
            legend: { position: 'bottom' },
            vAxis: {minValue: 0}
            
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
        </script>
    </div>

    <div id="curve_chart" style="width: 98%; height: 500px"></div>

    

    <div class="d-flex justify-content-center align-item-center">
        
        <div class="col-md-2"></div>

        <div class="col-md-8">
            <hr align=center width=100%>

            <div class="mb-3 d-flex justify-content-start flex-column">
                <h3 class="display-7 fw-bold">Itt tekintheti meg az előzményeket!</h1>
                <p class="fs-7"> Az egyes előzmények megtekintéséhez válassza ki az alábbi táblázatból azt a dátumot amely kitöltésének eredményére kíváncsi, majd kattintson a 
                    táblázat alatt található 'Megjelenítés' gombra</p>

            </div>

            <form method="post" class="d-flex justify-content-center flex-column">
            
                <select class="form-select mb-2" size="6" aria-label="size 3 select example" name="lehetosegek">
                    <option selected class="mb-3">Válasszon az alábbi dátumok közül</option>
                    <?php
                    foreach($elozok as $sor){
                        echo '<option value="'.$sor[0].'">'.$sor[1].'</option>';  
                    }
                    ?>

                </select>

                <div class="d-flex justify-content-center">
                    <input type="submit" name="egy-megjelen" class="btn btn-outline-dark" value="Megjelenítés"></input>
                </div>
                
            </form>
    
        </div>


        <div class="col-md-2"></div>

    </div>

    <?php
        if(isset($_POST['egy-megjelen'])){
            if(!empty($_POST['lehetosegek'])){
                $kivalasztott = intval($_POST['lehetosegek']);

                if($kivalasztott != null){
                    $quer = "SELECT * FROM `kitoltes` WHERE id = $kivalasztott";
                    $lekerdezes = mysqli_query($conn, $quer);
    
                    
                    $sor = mysqli_fetch_assoc($lekerdezes);
                    //Megfelelő sessionök beállítása
    
                    $_SESSION["etel_pont"] = floatval($sor['ert_etel']);
                    $_SESSION["otthon_pont"] = floatval($sor['ert_otthon']);
                    $_SESSION["kozlekedes_pont"] = floatval($sor['ert_kozlekedes']);
                    $_SESSION["vasarlas_pont"] = floatval($sor['ert_vasarlas']);
    
                    $_SESSION["osszes_pont"] = $_SESSION["etel_pont"]+$_SESSION["otthon_pont"]+$_SESSION["kozlekedes_pont"]+$_SESSION["vasarlas_pont"];
    
                    $_SESSION['datum'] = $sor['kitoltes_datum'];
                    
                    require 'kiegeszitok/egy_kitolt_megjelenites.php';

                    unset($_SESSION["datum"]);
                    

                }else{
                    echo'Kérem válasszon ki egy adatot a listából, hogy meg tudjuk jeleníteni';

                }
            }
        }
    ?>
</div>