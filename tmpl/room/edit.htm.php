<?php

$room = Provider::getRoom( $roomid );
?>

<div class="wrapper">

<div>
    <h1>Raum editieren: <?php echo $room->getNumber() ?></h1>
</div>

<form action="<?php echo $webroot?>rooms/<?php echo $roomid?>/edit" method="post">
	<div class="form-group">
        <label for="number">Nummer</label>
        <input name="number" type="text" class="form-control" value="<?php echo $room->getNumber()?>">
    </div>
    <div class="form-group">
        <label for="description">Beschreibung</label>
        <input name="description" type="text" class="form-control" value="<?php echo $room->getDescription()?>">
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>rooms">Abbrechen</a>
</form>

</div>