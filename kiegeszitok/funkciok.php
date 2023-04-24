<?php

function notFound(){
	echo '


	<div class="d-flex align-items-center justify-content-center m-5">
		<div class="text-center">
			<h1 class="display-1 fw-bold">404</h1>
			<p class="fs-3"> <span class="text-danger">Hoppá!</span> A keresett lap nem található</p>
			<p class="lead">
			A keresett lap eltávolításra került, vagy nem is létezett.
				</p>
			<a href="index.php?page=home" class="btn btn-outline-dark">Főoldal</a>
		</div>
	</div>
	
	';
}


?>