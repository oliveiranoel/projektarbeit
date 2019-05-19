<?php
$rooms = Provider::getRooms();
$detailview = Config::PATH_TEMPLATE . "room/detailview.htm.php";
$deleteConfirmation = "return confirm('Sind Sie sich sicher, dass sie diesen Raum l&#246;schen m&#246;chten ?')"
?>

<div class="wrapper">
    <div>
    	<h1>
    		R&#228;ume
    		<a href="<?php echo $webroot?>rooms/new">
    			<span class="glyphicon glyphicon-plus ml-3 tool" style="font-size: .8em;"></span>
    		</a>
    		<input class="float-right form-control col-3 tool" type="text" id="myInput" onkeyup="search()" placeholder="Suchen...">
    	</h1>
    </div>
    
    <div id="accordion">
        <?php 
        foreach ( $rooms as $room )
        {
        ?>
            <div class="card mb-1">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <button class="btn btn-link float-left search" data-toggle="collapse" data-target="#room_<?php echo $room->getRoomId()?>">
                      		<?php echo "[" . $room->getRoomId() . "] " .$room->getNumber() ?>
                        </button>
                    </h5>
                    <div class="btn-toolbar float-right tool" role="toolbar">
                        <div class="btn-group mr-2" role="group">
        					<a class="btn btn-primary" href="<?php echo $webroot?>rooms/<?php echo $room->getRoomId()?>/edit" role="button">
                            	<span class="glyphicon glyphicon-pencil"></span>
    						</a>
                        </div>
                        <div class="btn-group mr-2" role="group">
                        	<form action="<?php echo $webroot?>rooms/<?php echo $room->getRoomId()?>/delete" method="post">
                        		<button type="submit" class="btn btn-primary" onclick=" <?php echo $deleteConfirmation ?>">
                        			<span class="glyphicon glyphicon-trash"></span>
    							</button>
                        	</form>
                        </div>
    				</div>
            	</div>
            	<div id="room_<?php echo $room->getRoomId()?>" class="collapse" data-parent="#accordion">
                    <?php FileUtil::exists( $detailview ) ? include( $detailview ) : null;?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
