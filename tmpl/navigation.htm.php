<?php
use php\util\NavUtil;
?>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
	<a href="<?php echo $webroot?>home" style="width: 40px; height: 40px;">
		<span class="mt-2 glyphicon glyphicon-home" style="font-size: 1.4em;"></span>
	</a>
	
	<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="navbar-collapse offcanvas-collapse">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php NavUtil::isActive( $webroot . "users" )?>">
				<a class="nav-link" href="<?php echo $webroot?>users">Benutzer</a>
			</li>
			<li class="nav-item <?php NavUtil::isActive( $webroot . "objects" )?>">
				<a class="nav-link" href="<?php echo $webroot?>objects">Objekte</a>
			</li>
			<li class="nav-item <?php NavUtil::isActive( $webroot . "rooms" )?>">
				<a class="nav-link" href="<?php echo $webroot?>rooms">R&#228;ume</a>
			</li>
			<!--
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Settings</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#">Action</a> 
					<a class="dropdown-item" href="#">Another action</a> 
					<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
			-->
		</ul>
		<form class="form-inline my-2 my-lg-0" action="<?php echo $webroot?>logout.html" method="post">
			<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Log out</button>
		</form>
	</div>
</nav>
