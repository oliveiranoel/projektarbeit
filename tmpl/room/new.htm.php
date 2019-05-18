<?php

?>

<div class="wrapper">

<div>
    <h1>Neuer Raum</h1>
</div>

<form action="<?php echo $webroot?>rooms/new" method="post">
	<div class="form-group">
        <label for="number">Nummer</label>
        <input name="number" type="text" class="form-control" maxlength="35" placeholder="A600">
    </div>
    <div class="form-group">
        <label for="description">Beschreibung</label>
        <input name="description" type="text" class="form-control" placeholder="Lehrerzimmer">
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>rooms">Abbrechen</a>
</form>

</div>