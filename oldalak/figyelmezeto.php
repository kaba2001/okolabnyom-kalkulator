<?php

if(!empty($_SESSION["kitoltott"])){
    if(!empty($_SESSION["id"])){
        header("Location: index.php?page=kitoltes_kiertekelo");
    }else{
        echo'
            <div class="d-flex align-items-center justify-content-center m-5">
                <div class="text-center">
                    <h1 class="display-5 fw-bold">Figyelem!</h1>
                    <br>
                    <p class="fs-3"> Amennyiben bejelentkezés nélkül tekinti meg az eredményét, az nem lesz eltárolva! Ha nyomon szeretné követni fejlődését, kérem jelentkezzen be!</p>
                    <div class="d-flex justify-content-center">
                        <a href="index.php?page=kitoltes_kiertekelo" class="text-secondary h6 m-5 d-flex align-items-center">bejelentkezés nélkül</a>
                        <a href="index.php?page=bej_reg&param=reg" class="btn btn-outline-dark m-5">Bejelentkezés</a>
                    </div>
                    
                </div>
            </div>';
    }
}else{
    header("Location: index.php?page=kerdoiv&param=etel");
}



?>