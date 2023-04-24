<?php

class Valasz{
    public $id;
    public $sorszam;

    public function __construct(int $i, int $p){
        $this->id = $i;
        $this->sorszam = $p;
    }

    public function __toString(){
        return strval("Kérdés_id=".$this->id." Válasz=".$this->sorszam."| ");
    }
}

$valasz_lista = array();

foreach($_GET as $key => $value){
    $kulcs = explode("_",$key);
    if($kulcs[0] == "v"){
        $val = new Valasz(intval($kulcs[1]), intval($value));
        array_push($valasz_lista, $val);
    }
}



$aktualis_oldal = $_SESSION['valtas_elozmenyek'][count($_SESSION['valtas_elozmenyek'])-2];

$etel_pont = 0;
$vasarlas_pont = 0;
$otthon_pont = 0;
$kozlekedes_pont = 0;

$gateway = true;

$utotag = "etel";
$etel_tomb = tipus_ertek_szamito($utotag, $valasz_lista, $gateway, $aktualis_oldal);
$etel_pont = $etel_tomb[0];
$etel_helyes = $etel_tomb[1];

if($etel_helyes){
    $utotag = "vasarlas";
    $vasarlas_tomb = tipus_ertek_szamito($utotag, $valasz_lista, $gateway, $aktualis_oldal);
    $vasarlas_pont = $vasarlas_tomb[0];
    $vasarlas_helyes = $vasarlas_tomb[1];

    if($vasarlas_helyes){
        $utotag = "otthon";
        $otthon_tomb = tipus_ertek_szamito($utotag, $valasz_lista, $gateway, $aktualis_oldal);
        $otthon_pont = $otthon_tomb[0];
        $otthon_helyes = $otthon_tomb[1];

        if($otthon_helyes){
            $utotag = "kozlekedes";
            $kozlekedes_tomb = tipus_ertek_szamito($utotag, $valasz_lista, $gateway, $aktualis_oldal);
            $kozlekedes_pont = $kozlekedes_tomb[0];
            $kozlekedes_helyes = $kozlekedes_tomb[1];

            if($kozlekedes_helyes){
                
                
                $_SESSION["kitoltott"] = true;
                $_SESSION["adatb_ment"] = true;
                $_SESSION["etel_pont"] = $etel_pont;
                $_SESSION["vasarlas_pont"] = $vasarlas_pont;
                $_SESSION["otthon_pont"] = $otthon_pont;
                $_SESSION["kozlekedes_pont"] = $kozlekedes_pont;

                $ossz = $etel_pont + $vasarlas_pont + $otthon_pont + $kozlekedes_pont;

                $_SESSION["osszes_pont"] = $ossz;

                
                //Átmenés a figyelmeztető oldalra:
                echo'
                <script>
                    const uj_alternativ_vonal = window.location.pathname+"?"+"page=figyelmezeto";
                    console.log(uj_alternativ_vonal);
                    window.location.href = uj_alternativ_vonal;
                </script>
                ';
            }
        }
    }
}

//______________________________


function tipus_ertek_szamito($utotag, $valasz_lista, $helyesseg, $aktualis_oldal){
$utvonal_filetag = "jsons/kerdesek/kerdesek_";

$utvonal = $utvonal_filetag.$utotag.".json";

    if(szamolas_file_ell($utvonal)){
        $json_adat_nyers = file_get_contents($utvonal);
        $json_adat = json_decode(''.$json_adat_nyers.'',true);
        $pont_ert = 0;

        foreach($json_adat as $adat){ 

            $megvan = false;

            foreach($valasz_lista as $val){
                if($val->id == $adat['ID']){

                    $megvan = true;
                    
                    if(array_key_exists('CO2ertek', $adat)){

                        $valasz_sorszama = $val->sorszam;
                        $lehetseges_valaszok_szama = count($adat['CO2ertek']);
                        //echo "<br>valasz_sorszama=".$valasz_sorszama."   lehetseges_valaszok_szama=".$lehetseges_valaszok_szama;

                        if($valasz_sorszama >= 0 && $valasz_sorszama < $lehetseges_valaszok_szama){

                            $adott_valasz = $adat['CO2ertek'][$valasz_sorszama];
                            if (is_numeric($adott_valasz)) {
                                $co2_kibocsatas = $adat['CO2ertek'][$valasz_sorszama];
                                
                                $pont_ert += floatval($co2_kibocsatas);

                                if($pont_ert < 0){
                                    $pont_ert = 0;
                                }
                            }else if(is_string($adott_valasz)){

                                $muvelet_mennyiseg = $adat['CO2ertek'][$valasz_sorszama];
                                $muvelet = $muvelet_mennyiseg[0];
                                $mennyiseg = substr($muvelet_mennyiseg, 1);
                                $pont_ert = osszetett_adat($muvelet,$mennyiseg,$pont_ert);

                                if($pont_ert < 0){
                                    $pont_ert = 0;
                                }

                            } else {
                                hibauzenet("Érvénytelen válasz formátum a mi fileunkban(".$adat['ID'].")");
                            }
                        }else{
                            hibauzenet("Érvénytelen válasz formatum az alábbi válaszhoz: " .$adat['ID']);
                            oldalvalto_hatterszinezo($adat['tipus'],$adat['ID']);
                            $helyesseg = false;
                            break;
                        }
                    }else{
                        hibauzenet("A hiba nálunk van, nincs érvényes válaszlehetőség mező " .$adat['ID']);
                    }
                }
            }

            if(!$megvan){
                if($aktualis_oldal == $utotag){
                    hibauzenet("Adjon meg válaszlehetőséget az adott helyhez: ".$adat['ID']);
                    oldalvalto_hatterszinezo($adat['tipus'],$adat['ID']);
                }else{
                    oldalvalto($adat['tipus'],$adat['ID']);
                }
                $helyesseg = false;
                break;
            }
        }

    }else{
        hibauzenet("Az állományunk hiányos, így nem sikerült az adatfeldolgozás! Megértését köszönyjük, elnézést a kellemetlenégért");
    }
return [$pont_ert, $helyesseg];

}






function osszetett_adat($muvelet, $mennyiseg, $pont){
    switch($muvelet) {
        case '*': return $mennyiseg * $pont;
        case '/': return $mennyiseg / $pont;
        case '-': return $mennyiseg - $pont;
        case '+': return $mennyiseg + $pont;
    }
}


function hibauzenet($szoveg){
    echo'
    <script>
        document.getElementById("hibauzenet").innerHTML = "*'.$szoveg.'*";
    </script>';
    
}


function oldalvalto($tipus, $ID){
    //
    
    echo '<script>
        var searchParams = new URLSearchParams(window.location.search);
        
        if(searchParams.get(\'param\') != "'.$tipus.'"){
            searchParams.set("param", "'.$tipus.'");   
            window.location.search = searchParams.toString(); 
        }
        
    </script>';

    //
    
    echo '<script>
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set("kitoltes", "false");
            //window.location.search = searchParams.toString();  
            var newRelativePathQuery = window.location.pathname + "?" + searchParams.toString();
            history.pushState(null, "", newRelativePathQuery); 
        </script>';

}

function hatterszinezo($tipus, $ID){
    //Pirosra színezés
    echo'
    <script>
        
        var el = document.getElementById("'.$tipus.$ID.'");
        x = 3000;
        
        let eredeti_szin = el.style.backgroundColor;
        el.style.backgroundColor = "red";

       
        setTimeout(()=>{
        el.style.backgroundColor = eredeti_szin;
        }, x);
    </script>';
}

function oldalvalto_hatterszinezo($tipus, $ID){
    

    oldalvalto($tipus, $ID);
    hatterszinezo($tipus, $ID);
    
}



function szamolas_file_ell($filename){
    if(!file_exists($filename)){
        hibauzenet("Elnézést, de nem tudjuk elvégezni az adatszámítást. A probléma nálunk van.");
        return false;
    }else{
        return true;
    }
}
?>