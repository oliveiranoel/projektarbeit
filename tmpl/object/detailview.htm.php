<?php

?>

<div class="card-body">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <p><span class="text-muted font-italic">Objekt ID:</span> <?php echo $object->getObjectid()?></p>
    	</li>
        <li class="list-group-item">
        	<p><span class="text-muted font-italic">Beschreibung:</span> <?php echo $object->getObjectdescription()->getDescription()?></p>
    	</li>
    	<li class="list-group-item">
        	<p><span class="text-muted font-italic">Raum:</span> <?php echo $object->getRoom()->getNumber() . " (" . $object->getRoom()->getDescription() . ")"?></p>
    	</li>
    </ul>
</div>