<?php
$component = Provider::getComponent( $componentid );
?>

<div class="wrapper">

<div>
    <h1>Komponent editieren: <?php echo $component->getComponentdescription()->getDescription()?></h1>
</div>

<form action="<?php echo $webroot?>components/<?php echo $componentid?>/edit" method="post">
	<div class="form-group">
        <label for="description">Beschreibung</label>
        <input name="description" type="text" class="form-control" value="<?php echo $component->getComponentdescription()->getDescription()?>">
    </div>
    <div class="form-group">
        <label for="value">Wert</label>
        <input name="value" type="text" class="form-control" value="<?php echo $component->getComponentvalue()->getValue()?>">
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>components">Abbrechen</a>
</form>

</div>