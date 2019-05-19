<?php
$objects = Provider::getObjects();
$components = Provider::getComponents();
?>

<div class="wrapper">

<div>
	<h1>Neue Zuweisung</h1>
</div>

<form action="<?php echo $webroot?>assigns/new" method="post">
    <div class="form-group">
        <label for="object">Komponent</label>
        <select class="form-control" name="object">
            <?php 
            foreach ( $objects as $object )
            {
            ?>
                <option value="<?php echo $object->getObjectid()?>">
                	<?php echo $object->getObjectdescription()->getDescription() . " (ID: " . $object->getObjectid() . ")"?>
            	</option>
            <?php 
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="component">Komponent</label>
        <select class="form-control" name="component">
            <?php 
            foreach ( $components as $component )
            {
            ?>
                <option value="<?php echo $component->getComponentId()?>">
                	<?php echo $component->getComponentdescription()->getDescription() . ", " . $component->getComponentvalue()->getValue() . " (ID: " . $component->getComponentid() . ")"?>
            	</option>
            <?php 
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>assigns">Abbrechen</a>
</form>

</div>