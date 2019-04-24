<?php

?>

<div class="wrapper">

<div>
    <h1>Neuer Komponent</h1>
</div>

<form action="<?php echo $webroot?>components/new" method="post">
	<div class="form-group">
        <label for="componentid">Komponente ID</label>
        <input name="componentid" type="text" class="form-control" readonly>
    </div>
	<div class="form-group">
        <label for="description">Beschreibung</label>
        <input name="description" type="text" class="form-control" maxlength="35" placeholder="Hersteller">
    </div>
    <div class="form-group">
        <label for="value">Wert</label>
        <input name="value" type="text" class="form-control" placeholder="HP">
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>components">Abbrechen</a>
</form>

</div>