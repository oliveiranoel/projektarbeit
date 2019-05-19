<?php
$detailview = Config::PATH_TEMPLATE . "home/detailview.htm.php";
$objects = Provider::getObjects();
$rooms = Provider::getRooms();
$components = Provider::getComponents();
$objectComponents = Provider::getObjectComponents();
?>

<div class="wrapper">
    <div>
    	<h1>Home</h1>
    </div>
	
	<?php 
    foreach ( $rooms as $room )
    {
        echo "<h3 class='mt-4'> " . $room->getNumber() . "</h3>";
    ?>
    <div id="accordion"> 
    	<?php 
        foreach ( $objects as $object )
        {
            if ( $object->getRoom()->getRoomId() == $room->getRoomId() ) 
            {
        ?>
        <div class="card mb-1">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <button class="btn btn-link float-left" data-toggle="collapse" data-target="#object_<?php echo $object->getObjectid()?>">
                  		<?php echo $object->getObjectdescription()->getDescription() ?>
                    </button>
                </h5>
        	</div>
            <div id="object_<?php echo $object->getObjectid()?>" class="collapse" data-parent="#accordion">
            	<div class="card-body">
				<?php 
                foreach ( $objectComponents as $objectComponent )
                {
                    if ( $objectComponent->getObjectid() == $object->getObjectid() )
                    {
                        foreach ( $components as $component )
                        {
                            if ($component->getComponentid() == $objectComponent->getComponentId())
                            {
                                FileUtil::exists( $detailview ) ? include( $detailview ) : null;
                            }
                        }
                    }
                }
                ?>
                </div>
            </div>
		</div>
		<?php 
            }
        }
        ?> 
	</div>
	<?php 
    }   
    ?>
</div>
