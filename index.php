<div class="index_hatter">

<?php

include 'kiegeszitok/funkciok.php';

include 'oldalak/header.php';


$page = 'home';

if(isset($_GET['page'])){
	$page = $_GET['page'];
}
$file = 'oldalak/'.$page.'.php';

if(is_file($file)){
	include $file;
}
else{
	notFound();
}


include 'oldalak/footer.php';

?>

</div>

