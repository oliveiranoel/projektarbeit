<?php
use php\Provider;
use php\util\TemplateUtil;

$objects = Provider::getObjects();
$detailview = Config::PATH_TEMPLATE . "object/detailview.htm.php";

?>

<div class="wrapper">

<div>
	<h1>
		Objekte
		<a href="<?php echo $webroot?>objects/new">
			<span class="glyphicon glyphicon-plus ml-3" style="font-size: .8em;"></span>
		</a>
	</h1>
</div>

<div id="accordion">
    <?php 
    foreach ( $objects as $object )
    {
    ?>
        <div class="card mb-1">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <button class="btn btn-link float-left" data-toggle="collapse" data-target="#user_<?php echo $object->getObjectid()?>">
                  		<?php echo $object->getObjectdescription()->getDescription()?>
                    </button>
                </h5>
                <div class="btn-toolbar float-right" role="toolbar">
                    <div class="btn-group mr-2" role="group">
    					<a class="btn btn-primary" href="<?php echo $webroot?>objects/<?php echo $object->getObjectid()?>/edit" role="button">
                        	<span class="glyphicon glyphicon-pencil"></span>
						</a>
                    </div>
                    <div class="btn-group mr-2" role="group">
                    	<form action="<?php echo $webroot?>objects/<?php echo $object->getObjectid()?>/delete" method="post">
                    		<button type="submit" class="btn btn-primary">
                    			<span class="glyphicon glyphicon-trash"></span>
							</button>
                    	</form>
                    </div>
				</div>
        	</div>
        	<div id="user_<?php echo $object->getObjectid()?>" class="collapse" data-parent="#accordion">
                <?php TemplateUtil::exists( $detailview ) ? include( $detailview ) : null;?>
            </div>
        </div>
    <?php
    }
    ?>
</div>

</div>
