<?php
$object = Provider::getObject( $objectid );
$rooms = Provider::getRooms();
?>

<div class="wrapper">

<div>
	<h1>Objekt editieren: <?php echo $object->getObjectdescription()->getDescription()?></h1>
</div>

<form action="<?php echo $webroot?>objects/<?php echo $object->getObjectid()?>/edit" method="post">
    <div class="form-group">
        <label for="description">Objektbeschreibung</label>
        <input name="description" type="text" class="form-control" value="<?php echo $object->getObjectdescription()->getDescription()?>">
    </div>
    <div class="form-group">
        <label for="room">Raum</label>
        <select class="form-control" name="room">
            <?php 
            foreach ( $rooms as $room )
            {
            ?>
                <option value="<?php echo $room->getRoomId()?>" <?php if ( $room->getRoomId() == $object->getRoom()->getRoomId() ) echo "selected"?>>
                	<?php echo $room->getNumber() . " (" . $room->getDescription() . ")"?>
            	</option>
            <?php 
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>objects">Abbrechen</a>
</form>

</div>