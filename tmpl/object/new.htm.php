<?php

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
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
        </select>
    </div>
    <div class="form-group">
        <label for="room">Raum</label>
        <select class="form-control" name="room">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>objects">Abbrechen</a>
</form>

</div>