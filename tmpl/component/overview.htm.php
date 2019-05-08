<?php

$components = Provider::getComponents();
$detailview = Config::PATH_TEMPLATE . "component/detailview.htm.php";
$deleteConfirmation = "return confirm('Sind Sie sich sicher, dass sie diesen Komponenten l&#246;schen m&#246;chten ?')"

?>

<div class="wrapper">
    <div>
    	<h1>
    		Komponente
    		<a href="<?php echo $webroot?>components/new">
    			<span class="glyphicon glyphicon-plus ml-3" style="font-size: .8em;"></span>
    		</a>
    	</h1>
    </div>
    
    <div id="accordion">
        <?php 
        foreach ( $components as $component )
        {
        ?>
            <div class="card mb-1">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <button class="btn btn-link float-left" data-toggle="collapse" data-target="#component_<?php echo $component->getComponentId()?>">
                      		<?php echo "[" . $component->getComponentId() . "] " . $component->getComponentdescription()->getDescription() ?>
                        </button>
                    </h5>
                    <div class="btn-toolbar float-right" role="toolbar">
                        <div class="btn-group mr-2" role="group">
        					<a class="btn btn-primary" href="<?php echo $webroot?>components/<?php echo $component->getComponentId()?>/edit" role="button">
                            	<span class="glyphicon glyphicon-pencil"></span>
    						</a>
                        </div>
                        <div class="btn-group mr-2" role="group">
                        	<form action="<?php echo $webroot?>components/<?php echo $component->getComponentId()?>/delete" method="post">
                        		<button type="submit" class="btn btn-primary" onclick=" <?php echo $deleteConfirmation ?>">
                        			<span class="glyphicon glyphicon-trash"></span>
    							</button>
                        	</form>
                        </div>
    				</div>
            	</div>
            	<div id="component_<?php echo $component->getComponentId()?>" class="collapse" data-parent="#accordion">
                    <?php FileUtil::exists( $detailview ) ? include( $detailview ) : null;?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
