<?php

if(empty($_SESSION["id"])){
    header("Location: index.php?page=bej_reg&param=bej");
}else{
    if(!empty($_SESSION["kitoltott"])){
        header("Location: index.php?page=kitoltes_kiertekelo");
    }else{
        require 'bej_reg_db_kapcs/konfiguracio.php';
        $loc_id = $_SESSION["id"];
        $lekerdezes = mysqli_query($conn, "SELECT * FROM `felhasznalo` WHERE id = $loc_id");
        $sor = mysqli_fetch_assoc($lekerdezes);
        $f_nev = $sor["felhasznalonev"];

        echo'
        <div class="d-flex align-items-center justify-content-center m-5">
            <div class="text-center">
                <h3 class="display-3 fw-bold">Sikeresen bejelentkezett!</h3>
                <p class="fs-3">Üdvözöljük '.$f_nev.'!</p>
                <p class="lead">
                Innentől akármikor visszanézheti az előzetesen kitöltött kérdőíveket.
                    </p>
                
                <a href="index.php?page=elozmenyek" class="btn btn-outline-dark mb-4">Előzmények</a>
                <p class="lead">
                Kérdőívet szeretne kitölteni?
                </p>
                <a href="index.php?page=kerdoiv&param=etel" class="btn btn-outline-success">Kérdőív</a>

            </div>
        </div>
        
        ';
    }
    
}



?>