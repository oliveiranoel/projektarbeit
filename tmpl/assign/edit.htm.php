<?php
$objects = Provider::getObjects();
$components = Provider::getComponents();

$obj = Provider::getObject( $objectid );
$comp = Provider::getComponent( $componentid );
?>

<div class="wrapper">

<div>
	<h1>
		Zuweisung editieren: 
		<?php echo "[" . $obj->getObjectid() . "] " . $obj->getObjectdescription()->getDescription() . " | " . $comp->getComponentdescription()->getDescription()?>
	</h1>
</div>

<form action="<?php echo $webroot?>assigns/<?php echo $objectid . "/" . $componentid?>/edit" method="post">
    <div class="form-group">
        <label for="object">Komponent</label>
        <select class="form-control" name="object">
            <?php 
            foreach ( $objects as $object )
            {
            ?>
                <option value="<?php echo $object->getObjectid()?>" <?php if ( $objectid == $object->getObjectid() ) echo "selected"?>>
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
                <option value="<?php echo $component->getComponentId()?>" <?php if ( $componentid == $component->getComponentId() ) echo "selected"?>>
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