<?php
$objects = Provider::getUsers();
$detailview = Config::PATH_TEMPLATE . "user/detailview.htm.php";
$deleteConfirmation = "return confirm('Sind Sie sich sicher, dass sie diesen Benutzer l&#246;schen m&#246;chten ?')"
?>

<div class="wrapper">

<div>
	<h1>
		Benutzer
		<a href="<?php echo $webroot?>users/new">
			<span class="glyphicon glyphicon-plus ml-3 tool" style="font-size: .8em;"></span>
		</a>
		<input class="float-right form-control col-3 tool" type="text" id="myInput" onkeyup="search()" placeholder="Suchen...">
	</h1>
</div>

<div id="accordion">
    <?php 
    foreach ( $objects as $user )
    {
    ?>
        <div class="card mb-1">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <button class="btn btn-link float-left search" data-toggle="collapse" data-target="#user_<?php echo $user->getUserid()?>">
                  		<?php echo $user->getFirstname() . " " . $user->getName() ?>
                    </button>
                </h5>
                <div class="btn-toolbar float-right tool" role="toolbar">
                    <div class="btn-group mr-2" role="group">
    					<a class="btn btn-primary" href="<?php echo $webroot?>users/<?php echo $user->getUserid()?>/edit" role="button">
                        	<span class="glyphicon glyphicon-pencil"></span>
						</a>
                    </div>
                    <div class="btn-group mr-2" role="group">
                    	<form action="<?php echo $webroot?>users/<?php echo $user->getUserid()?>/delete" method="post">
                    		<button type="submit" class="btn btn-primary" onclick=" <?php echo $deleteConfirmation ?>">
                    			<span class="glyphicon glyphicon-trash"></span>
							</button>
                    	</form>
                    </div>
				</div>
        	</div>
        	<div id="user_<?php echo $user->getUserid()?>" class="collapse" data-parent="#accordion">
                <?php FileUtil::exists( $detailview ) ? include( $detailview ) : null;?>
            </div>
        </div>
    <?php
    }
    ?>
</div>

</div>
