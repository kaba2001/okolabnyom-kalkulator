<?php
require 'bej_reg_db_kapcs/konfiguracio.php';
$_SESSION = [];
session_unset();
session_destroy();
header("Location: index.php");


?>