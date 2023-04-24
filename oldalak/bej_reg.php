<main class="my-5 kerdoiv">


    <div class="col-md-4"></div>

    <div class="container col-md-4 p-0 kerekito">
        
        <form action="bej_reg_action" method="post" class="middle d-flex m-0">

        <label class="flex-fill">
            <input type="radio" name="ans" value="bej" onclick="url_rako()"/>
            <div class="bej box p-2">
                <span>Bejelentkezés</span>
            </div>
        </label>

        <label class="flex-fill">
            <input type="radio" name="ans" value="reg" onclick="url_rako()"/>
            <div class="reg box p-2">
                <span>Regisztráció</span>
            </div>
        </label>

        </form>


        <script src="sajat_java/url_macera_kerdoiv.js"></script>
        <?php
        
        include 'kiegeszitok/bej_reg_generalo.php';
        
        ?>

    </div>



    <div class="col-md-4"></div>

    
</main>