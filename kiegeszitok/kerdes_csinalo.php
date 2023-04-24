<?php
if (!isset($_SESSION['valtas_elozmenyek'])) {
    $_SESSION['valtas_elozmenyek'] = array();
}

if(isset($_GET['param'])){
    json_feldolgozo($_GET['param']);
}

function json_feldolgozo($filename){
    $utvonal = "jsons/kerdesek/kerdesek_".$filename.".json";
    
    array_push($_SESSION['valtas_elozmenyek'], $filename);

    if($filename == "kozlekedes"){
        $_SESSION['elert_vegere'] = true;
    }else{
        unset($_SESSION['elert_vegere']);
    }


    if(file_ellenorzo($utvonal)){
        $json_adat_nyers = file_get_contents($utvonal);
        $json_adat = json_decode(''.$json_adat_nyers.'',true);
    
        echo'<form action="" method="post" autocomplete="off" class="pb-0 mb-0">';
        foreach($json_adat as $adat){ 
            echo '<div class="kerdes_box '.$filename.'" id='.$filename.$adat['ID'].'>';
        
            kerdes_hozzaado($adat);

            echo '</div>';
        }

        gomb_hozzaado($filename);
    }
    echo'</form>';
    
    if(isset($_POST["submit"])){
        kesz_ellenorzo();
    }
}

function kerdes_hozzaado($adat){
    echo'
    <div class="kerdes py-3 px-2">
        '.$adat['kerdes'].'
    </div>';

    echo '<div class="lehetosegek d-flex flex-wrap">';
    //lable class: 
    for($i = 0; $i < count($adat['valaszok']); $i++){
        $i == 0 ? $el = "border-bal-0" : $el = "";
        

        
        echo '
        <label class="flex-fill '.$adat['tipus'].' egy_opcio" onclick="valasz_mentes('.$adat['ID'].','.$i.');">

            <input type="radio" name="valasz'.$adat['ID'].'" id="lehetoseg_'.$adat['ID'].'_'.$i.'">

            <div class="valasz p-2 px-4 also_box d-flex justify-content-center '.$el.'">
                <span>'.$adat['valaszok'][$i].'</span>
            </div>
        </label>';
    }

    

    echo '</div>
    <script>
        mult_ellenorzo('.$adat['ID'].');
    </script>
    ';
    
    

    
}

function gomb_hozzaado($osztaly){
    echo '
    <div id = "bekuldo_gomb_hatter" class="p-3 '.$osztaly.'">
        <lable class="d-flex justify-content-center ">
            <div class = "bekuldo_div">';

                if(empty($_SESSION['elert_vegere'])){
                    echo '<button type="submit" name="submit" class = "btn-bekuldo '.$osztaly.'">Következő oldal</button>';
                }else{
                    echo '<button type="submit" name="submit" class = "btn-bekuldo '.$osztaly.'">Beküldés</button>';   
                }
                
                
                
            echo'</div>
        </lable>
            
    </div>
    
    <div class="tooltip">Hover over me
        
    </div>';
    

}

function kesz_ellenorzo(){
    echo '
    <script>kitoltottseg_ell();</script>
    ';
    
}

function file_ellenorzo($filename){
    if(!file_exists($filename)){
        notFound();
        return false;
    }else{
        return true;
    }
}
?>