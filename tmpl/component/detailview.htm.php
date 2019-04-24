<?php

?>

<div class="card-body">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <p><span class="text-muted font-italic">Komponente ID:</span> <?php echo $component->getComponentId()?></p>
    	</li>
        <li class="list-group-item">
        	<p><span class="text-muted font-italic">Beschreibung:</span> <?php echo $component->getComponentdescription()->getDescription()?></p>
    	</li>
        <li class="list-group-item">
        	<p><span class="text-muted font-italic">Wert:</span> <?php echo $component->getComponentvalue()->getValue() ?></p>
    	</li>
    </ul>
</div>