<?php

$rooms = Provider::getRooms();
?>

<div class="wrapper">

<div>
    <h1>Neues Objekt</h1>
</div>

<form action="<?php echo $webroot?>objects/new" method="post">
    <div class="form-group">
        <label for="description">Objektbeschreibung</label>
        <input name="description" type="text" class="form-control" placeholder="Beamer">
    </div>
    <div class="form-group">
        <label for="room">Raum</label>
        <select class="form-control" name="room">
            <?php 
            foreach ( $rooms as $room )
            {
            ?>
                <option value="<?php echo $room->getRoomId()?>" <?php if ( $room->getRoomId() == Config::DEFAULT_ROOM_ID ) echo "selected"?>>
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