<?php


if(isset($_GET['param'])){
    $oldal = ($_GET['param']);
}

$bej = "bej";
$reg = "reg";

if($oldal == $bej){
    bej_generalo($oldal);
}else if($oldal == $reg){
    reg_generalo($oldal);
}else{
    notFound();
}


function bej_generalo($oldal){
    

    echo'
        <div class = "p-5 pb-1 '.$oldal.'">
            <form action="" method="post" autocomplete="off" class="m0">
                <p class = "mb-0">
                    Felhasználónév
                </p>
                
                <input type="text" class = "mb-3 bemeno_doboz" name="fnev" id="fnev" required>

                <p class = "mb-0 mt-3">
                    Jelszó
                </p>
                <input type="password" class = "mb-3 bemeno_doboz" name="jelszo" id="jelszo" required>
                ';
                gomb_hozzaado($oldal);
                echo'
            </form>
            '.error_mezo().'
        </div>';

    require 'bej_reg_db_kapcs/konfiguracio.php';
    if(isset($_POST["submit"])){
        $nev = $_POST["fnev"];
        $jelszo = $_POST["jelszo"];

        $eredmeny = mysqli_query($conn, "SELECT * FROM felhasznalo WHERE felhasznalonev = '$nev'");
        $sor = mysqli_fetch_assoc($eredmeny);
        if(mysqli_num_rows($eredmeny) > 0){
            if($jelszo == $sor["jelszo"]){
                
                bejelentkezteto($nev);
                
            }else{
                uzenet_fhsz("Rossz jelszó");
            }
            
        }else{
            uzenet_fhsz('Ez a felhasználó még nincs regisztrálva');
        }

    }
    
    
}

function reg_generalo($oldal){
    

    echo'
        <div class = "p-5 pb-1 '.$oldal.'">
            <form action="" method="post" autocomplete="off" class="m0">
                <p class = "mb-0">
                Felhasználónév
                </p>

                <input type="text" class = "mb-3 bemeno_doboz" id="fnev" name = "fnev" required>

                <p class = "mb-0 mt-3">
                    Jelszó
                </p>
                <input type="password" class = "mb-3 bemeno_doboz" id="jelszo" name="jelszo" required>


                <p class = "mb-0 mt-3">
                    Jelszó újra
                </p>
                <input type="password" class = "mb-3 bemeno_doboz" id="jelszo_ujra" name="jelszo_ujra" required>

                <br>
                ';
                gomb_hozzaado($oldal);
                
                echo'
            </form>

            '.error_mezo().'
        </div>';
    

    require 'bej_reg_db_kapcs/konfiguracio.php';
    if(isset($_POST["submit"])){
        
        $nev = $_POST["fnev"];
        $jelszo = $_POST["jelszo"];
        $jelszo_ujra = $_POST["jelszo_ujra"];
        $masolat = mysqli_query($conn, "SELECT * FROM felhasznalo WHERE felhasznalonev = '$nev'");
        if(mysqli_num_rows($masolat) > 0){
            uzenet_fhsz("A maga által megadott felhasználónév ($nev) már foglalt. Kérem válasszon másikat!");
        }else if($jelszo != $jelszo_ujra){
            uzenet_fhsz("A két megadott jelszó nem egyezik!");
            
        }else if(strlen($nev)<1){
            uzenet_fhsz("A felhasználónév túl rövid");

        }else if(strlen($jelszo)<2){
            uzenet_fhsz("A maga által megadott jelszó túl rövid");

        }else{
            $query = "INSERT INTO `felhasznalo`(`felhasznalonev`, `jelszo`) VALUES ('$nev','$jelszo')";
            mysqli_query($conn, $query);
            
            bejelentkezteto($nev);
            
        }
        

    }
    


}

function gomb_hozzaado($osztaly){
    echo '
    <div id = "bekuldo_gomb_hatter" class="p-3 '.$osztaly.'">
        <lable class="d-flex justify-content-center ">
            <div class = "bekuldo_div">
                <button type="submit" name="submit" class = "btn-bekuldo '.$osztaly.'">Beküldés</button>
                
            </div>
        </lable>
            
    </div>
   
    ';
    

}

function error_mezo(){
    echo'<span id = "hibauzenet" class="error text-danger"></span>';
}


function uzenet_fhsz($szoveg){
    echo'
    <script> 
        document.getElementById("hibauzenet").innerHTML = "*'.$szoveg.'*";
    </script>';
    
}

function bejelentkezteto($nev){

    $id = id_meghatarozo($nev);

    $_SESSION["bejelentkezes"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["fnev"] = $nev;

    echo'
    <script>

    var searchParams = new URLSearchParams(window.location.search);   
    searchParams.set("page", "sikeres_bej");
    window.location.search = searchParams.toString(); 
    

    </script>
    ';
    
}

function id_meghatarozo($nev){
    require 'bej_reg_db_kapcs/konfiguracio.php';
    $eredmeny = mysqli_query($conn, "SELECT * FROM felhasznalo WHERE felhasznalonev = '$nev'");
    $sor = mysqli_fetch_assoc($eredmeny);
    return $sor["id"];

}
?>