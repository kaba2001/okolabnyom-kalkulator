

<main class="my-5 kerdoiv">
    
    <span id = "hibauzenet" class="error text-danger d-flex justify-content-center mb-3"></span>

    <div class="col-md-2"></div>
    
    <div class="container col-md-8 p-0 kerekito">
        
        
        <form action="kerdesek" method="post" class="middle d-flex flex-wrap m-0">
            
            <label class="flex-fill">
                <input type="radio" name="ans" value="etel" onclick="url_rako() "/>
                <div class="etel box p-2">
                    <span>Étel</span>
                </div>
            </label>
                
            <label class="flex-fill">
                <input type="radio" name="ans" value="vasarlas" onclick="url_rako()"/>
                <div class="vasarlas box  p-2">
                    <span>Vásárlás</span>
                </div>
            </label>

            <label class="flex-fill">
                <input type="radio" name="ans" value="otthon" onclick="url_rako()"/>
                <div class="otthon box p-2">
                    <span>Otthon</span>
                </div>
            </label>

            <label class="flex-fill">
                <input type="radio" name="ans" value="kozlekedes" onclick="url_rako()"/>
                <div class="kozlekedes box p-2">
                    <span>Közlekedés</span>
                </div>
            </label>
        
        </form>
        <script src="sajat_java/url_macera_kerdoiv.js"></script>
        <script src="sajat_java/valasz_megjegyzes.js"></script>
        <script src="sajat_java/kesz_ellenorzo.js"></script>
        
        
        
        <?php
        
        include 'kiegeszitok/kerdes_csinalo.php';
        
        ?>
        
    </div>

    <?php

    if(!empty($_GET["kitoltes"])){
        if($_GET["kitoltes"]=="true"){
            include 'kiegeszitok/kerdes_feldolgozo.php';
        }
    }
    
    

    ?>

    <div class="col-md-2"></div>

  

    
    
</main>

<!--<script src="sajat_java/ujratoltes_szamolo.js"></script>-->