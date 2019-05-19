
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
	<a href="<?php echo $webroot?>home" class="icon-container">
		<span class="mt-2 glyphicon glyphicon-home icon"></span>
	</a>
	
	<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="navbar-collapse offcanvas-collapse navigation">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php NavUtil::isActive( $webroot . "users" )?>" <?php NavUtil::onlyAdmin()?>>
				<a class="nav-link" href="<?php echo $webroot?>users">Benutzer</a>
			</li>
			<li class="nav-item <?php NavUtil::isActive( $webroot . "rooms" )?>">
				<a class="nav-link" href="<?php echo $webroot?>rooms">R&#228;ume</a>
			</li>
			<li class="nav-item <?php NavUtil::isActive( $webroot . "objects" )?>">
				<a class="nav-link" href="<?php echo $webroot?>objects">Objekte</a>
			</li>
			<li class="nav-item <?php NavUtil::isActive( $webroot . "components" )?>">
				<a class="nav-link" href="<?php echo $webroot?>components">Komponente</a>
			</li>
			<li class="nav-item <?php NavUtil::isActive( $webroot . "assigns" )?>">
				<a class="nav-link" href="<?php echo $webroot?>assigns">Zuweisung</a>
			</li>
		</ul>
		
		<?php 
		if ( isset( $_SESSION[ "AUTH_NAME" ] ) )
		{
		?>
		<div class="d-none d-lg-block greeting">
			Hallo, <?php echo $_SESSION[ "AUTH_NAME" ] ?>
		</div>
		<?php 
		}
		?>
	
    	<form class="form-inline my-2 my-lg-0 " action="<?php echo $webroot?>logout.html" method="post">
    		<button class="btn btn-outline-primary my-2 my-sm-0 logout" type="submit">Log out</button>
    	</form>
	</div>
</nav>
