<?php

$objectdescriptions = Provider::getObjectDescriptions();
$rooms = Provider::getRooms();
?>

<div class="wrapper">

<div>
    <h1>Neues Objekt</h1>
</div>

<form action="<?php echo $webroot?>objects/new" method="post">
	<div class="form-group">
        <label for="userid">Objekt ID</label>
        <input name="userid" type="text" class="form-control" readonly>
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