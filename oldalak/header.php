<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szakdolgozat_BK</title>

    <link rel="icon" type = "image/x-icon" href="src/imgs/favicon.ico">

    <link rel="stylesheet" href="src/css/bootstrap.css">
    <link rel="stylesheet" href="src/style.css">
    <link rel="stylesheet" href="src/kerdoiv.css">
    
    

</head>
<body id = "felulet" class="bg-main-zold">
    
    <header>
        <?php
        session_start();
        ?>
        <div class="collapse" id="navbarToggleExternalContent">

            <div class="bg-dark p-4">
                <h5 class="text-white h4">Collapsed content</h5>
                <span class="text-muted">Toggleable via the navbar brand.</span>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-sotetkek">
            <div class="container">
                <div class="logo_felirat">
                <a href="index.php?page=home"><img src="src/imgs/logo.png" width="50px" alt=""></a>
                <a class="navbar-brand" href="index.php?page=home">Ökolábnyom kalkulátor</a>
                
                </div>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item d-flex justify-content-end">
                            <a class="nav-link-sajat-feher" href="index.php?page=home">Főoldal</a>
                        </li>
                        <li class="nav-item d-flex justify-content-end">
                            <a class="nav-link-sajat-zold" href="index.php?page=kerdoiv&param=etel">Kérdőív</a>
                        </li>
                        
                        
                        

                        <?php
                        if(empty($_SESSION["id"])){
                            echo'
                            <li class="nav-item d-flex justify-content-end">
                                <a class="nav-link-sajat-feher" href="index.php?page=bej_reg&param=bej">Bejelentkezés </a> <a class="nav-link-sajat-feher px-1" href="index.php?page=bej_reg&param=reg">/regisztráció</a>
                            </li>
                            
                            ';
                        }else{
                            echo'
                            <li class="nav-item d-flex justify-content-end">
                                <a class="nav-link-sajat-feher" href="index.php?page=elozmenyek">Előzmények</a>
                            </li>
                            <li class="nav-item d-flex justify-content-end">
                                <a class="nav-link-sajat-feher" href="index.php?page=kijelentkezes">Kijelentkezés</a>
                            </li>
                            
                            ';
                        }
                        ?>
                        <li class="nav-item d-flex justify-content-end mt-3">
                            <a class="nav-link-sajat-feher" href="https://forms.gle/WG5iVHXgy4ywfcdG7" target="_blank">Weboldal értékelése</a>
                        </li>
                    </ul>                 
                </div>
            </div>
        </nav>
    </header>