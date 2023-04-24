<script src="sajat_java/alapallapot.js"></script>

<main class="my-5 fooldal">

<div class="container my-5 bg-warning figyelem">
  <div class="alert alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  
    <strong>Szakdolgozat!</strong> Benkő Kaba programtervező informatikus BsC diplomamunka - 2022,23
  </div>
  
</div>

<div class="container">
  <div class="row">
      <div class="col-md-6 mt-3">
          <h2 class="text-center mb-3">Ökolábnyom kalkulátor</h2>
          <p class="bemutatkozo">
            Földünk védelme, természeti csodáink megőrzése, generációkat átívelő társadalmi 
            konszenzussá nőtte ki magát az elmúlt évtizedekben.
            Bár ezzel a gondolattal sok ember egyetért, azt mégse tudjuk, hogy saját mindennapi tevékenységeinkkel
            milyen mennyiségben szennyezzük a bolygót. A weblap célja, a saját ökológiai lábnyomunk "nagy átlaghoz" történő viszonyítása.

          </p>
          <p>
            <i>A weblapon található CO<sub>2</sub> kibocsátással kapcsolatos értékek, fenntartással kezelendők!</i>
          </p>
      </div>

      <div class="col-md-1"></div>

      <div class="col-md-5">
          <div class="card-img landpage_img">
              <img src="src/imgs/landing_img.png" alt="" class="img-fluid">
          </div>
          
      </div>
  </div>
</div>

<div class="container my-5">
    <div class="bg-sotetkek text-white my-3 py-1 text-center container my-5">
        
    </div>
</div>

<div class="container my-5">
  <div class="row">
    <div class="col-md-2"></div>
    
    <div class="col-md-8">
      <h1 class="mb-3">Kitöltési útmutató</h1>

      <ul class="nav justify-content-strat">
          <li class="nav-item">
            <p>
            A kérdőív elkezdéséhez az oldal alján található 'kezdés' gombra kell kattintani.  
            </p>
            
      
          </li>
          <li class="nav-item">
            <p>
            A kérdőívben négy nagy témába vannak feltéve kérdések. Automatikusan az étellel kapcsolatos lapon 
            kezdődik a kitöltés, de a kitöltés sorrendje tetszőlegesen változtatható  
            </p>
          </li>
          <li class="nav-item">
          <p>
            A témák közti navigáláshoz az oldal alján található 'következő oldal' funkciót válassza. Az utolsó 
            témakör kérdései után a 'beküldés' gombbal tudja befejezni a kitöltést
          </p>    
          </li>
          
          <li class="nav-item">
          <p>
            Egy kérdésre egy válaszlehetőséget jelölhet meg. Ha a későbbiekben vissza szeretne menni a már korábban kitöltött
            kérdésekhez, és módosítani szeretné az adott válaszát, arra van lehetősége. Ehhez az adott témakör fülére kell kattintania. 
          </p>    
          </li>
      </ul>
      
    </div>

    <div class="col-md-2"></div>
  </div>  
</div>

<div class="d-flex justify-content-center">
    <a href="index.php?page=kerdoiv&param=etel" class="btn btn-sajat">kezdés</a>
</div>


<script>
  localStorage.clear();
</script>

<?php
unset($_SESSION['valtas_elozmenyek']);

?>


</main>
