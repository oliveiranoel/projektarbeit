<?php

$assigns = Provider::getObjectComponents();
$detailview = Config::PATH_TEMPLATE . "assign/detailview.htm.php";
$deleteConfirmation = "return confirm('Sind Sie sich sicher, dass sie dieses Assign l&#246;schen m&#246;chten ?')"

?>

<div class="wrapper">

<div>
	<h1>
		Assign
		<a href="<?php echo $webroot?>assigns/new">
			<span class="glyphicon glyphicon-plus ml-3" style="font-size: .8em;"></span>
		</a>
		<input class="float-right form-control col-3" type="text" id="myInput" onkeyup="search()" placeholder="Suchen...">
	</h1>
</div>

<div id="accordion">
    <?php 
    foreach ( $assigns as $assign )
    {
    	$object = Provider::getObject( $assign->getObjectid() );
    	$component = Provider::getComponent( $assign->getComponentid() );
    ?>
        <div class="card mb-1">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <button class="btn btn-link float-left search" data-toggle="collapse" data-target="#assign_<?php echo $assign->getObjectid() . "_" . $assign->getComponentid()?>">
                  		<?php echo "[" . $object->getObjectid() . "] " . $object->getObjectdescription()->getDescription() . " | " . "[" . $component->getComponentid() . "] " . $component->getComponentdescription()->getDescription()?>
                    </button>
                </h5>
                <div class="btn-toolbar float-right" role="toolbar">
                    <div class="btn-group mr-2" role="group">
    					<a class="btn btn-primary" href="<?php echo $webroot?>assigns/<?php echo $assign->getObjectid() . "/" . $assign->getComponentid()?>/edit" role="button">
                        	<span class="glyphicon glyphicon-pencil"></span>
						</a>
                    </div>
                    <div class="btn-group mr-2" role="group">
                    	<form action="<?php echo $webroot?>assigns/<?php echo $assign->getObjectid() . "/" . $assign->getComponentid()?>/delete" method="post">
                    		<button type="submit" class="btn btn-primary" onclick=" <?php echo $deleteConfirmation ?>">
                    			<span class="glyphicon glyphicon-trash"></span>
							</button>
                    	</form>
                    </div>
				</div>
        	</div>
        	<div id="assign_<?php echo $assign->getObjectid() . "_" . $assign->getComponentid()?>" class="collapse" data-parent="#accordion">
				<?php FileUtil::exists( $detailview ) ? include( $detailview ) : null;?>
            </div>
        </div>
    <?php
    }
    ?>
    
    
</div>

</div>
