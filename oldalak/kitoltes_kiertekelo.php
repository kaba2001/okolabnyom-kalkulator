<?php
if(empty($_SESSION["kitoltott"])){
    header("Location: index.php?page=kerdoiv&param=etel");
}else{
    if(!empty($_SESSION["id"])){
        
        if(!empty($_SESSION["adatb_ment"])){
            //Adatbázis mentés
            
            require 'bej_reg_db_kapcs/konfiguracio.php';

            $felhaszn_id = $_SESSION["id"];
            $datum = date("Y-m-d H:i:s");
            $ert_etel = $_SESSION["etel_pont"];
            $ert_vasarlas = $_SESSION["vasarlas_pont"];
            $ert_otthon = $_SESSION["otthon_pont"];
            $ert_kozlekedes = $_SESSION["kozlekedes_pont"];

            $query = "INSERT INTO `kitoltes`(`felhaszn_id`, `kitoltes_datum`, `ert_etel`, `ert_vasarlas`,`ert_otthon`,`ert_kozlekedes`) VALUES ('$felhaszn_id','$datum','$ert_etel','$ert_vasarlas','$ert_otthon','$ert_kozlekedes')";
            mysqli_query($conn, $query);

            $_SESSION["adatb_ment"] = null;
        }  
    }
    local_storage_clear();
    unset($_SESSION['valtas_elozmenyek']);

    require 'kiegeszitok/egy_kitolt_megjelenites.php';

    if(!empty($_SESSION['fnev'])){
        echo'
        <div class="d-flex align-items-center justify-content-center m-5 text-center flex-column">
        
            <h3 class="fw-bold">Az előzmények megtekintéséhez kattintson az előzmények gombra</h3>
            
            
            <a href="index.php?page=elozmenyek" class="btn btn-outline-dark mb-4">Előzmények</a>
        
        </div>
    
    
    ';
    }
    


}

function local_storage_clear(){
    echo'
    <script>
        localStorage.clear();
    </script>';
}



?>