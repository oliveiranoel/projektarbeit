<?php
use php\util\NavUtil;
?>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
	<a href="<?php echo $webroot?>home">
		<img class="mr-3" src="<?php echo $webroot?>img/bootstrap-solid.svg" alt="" width="40"
		height="40">
	</a>
	
	<button class="navbar-toggler p-0 border-0" type="button"
		data-toggle="offcanvas">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="navbar-collapse offcanvas-collapse"
		id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php NavUtil::isActive( $webroot . "test.html" )?>">
				<a class="nav-link" href="<?php echo $webroot?>test.html">Test</a>
			</li>
			<li class="nav-item <?php NavUtil::isActive( $webroot . "users" )?>">
				<a class="nav-link" href="<?php echo $webroot?>users">Benutzer</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
					<a class="dropdown-item" href="#">Action</a> 
					<a class="dropdown-item" href="#">Another action</a> 
					<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button>
		</form>
	</div>
</nav>
