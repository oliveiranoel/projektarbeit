<?php
use php\Provider;

$object = Provider::getObject( $objectid );
$objectdescriptions = Provider::getObjectDescriptions();
$rooms = Provider::getRooms();

// TODO selected
// TODO sollte die Bezeichnung frei eingegeben werden können und Duplikate werden per Code überprüft?
?>

<div class="wrapper">

<div>
	<h1>Objekt editieren: <?php echo $object->getObjectdescription()->getDescription()?></h1>
</div>

<form action="<?php echo $webroot?>objects/new" method="post">
	<div class="form-group">
        <label for="userid">Objekt ID</label>
        <input name="userid" type="text" class="form-control" value="<?php echo $object->getObjectid()?>" readonly>
    </div>
    <div class="form-group">
        <label for="objectdescription">Objektbeschreibung</label>
        <select class="form-control" name="objectdescription">
            <?php 
            foreach ( $objectdescriptions as $objectdescription )
            {
            ?>
                <option value="<?php echo $objectdescription->getObjectdescriptionId()?>"><?php echo $objectdescription->getDescription()?></option>
            <?php 
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="room">Raum</label>
        <select class="form-control" name="room">
            <?php 
            foreach ( $rooms as $room )
            {
            ?>
                <option value="<?php echo $room->getRoomId()?>"><?php echo $room->getDescription() . " " . $room->getNumber()?></option>
            <?php 
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>objects">Abbrechen</a>
</form>

</div>