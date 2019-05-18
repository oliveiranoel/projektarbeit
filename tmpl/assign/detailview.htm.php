
<div class="card-body">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
        	<p>
        		<span class="text-muted font-italic">Objekt:</span> 
    			<?php echo $object->getObjectdescription()->getDescription()?>
			</p>
    	</li>
    	<li class="list-group-item">
        	<p>
        		<span class="text-muted font-italic">Komponent:</span> 
    			<?php echo $component->getComponentdescription()->getDescription()?>
    		</p>
    	</li>
    	<li class="list-group-item">
        	<p>
        		<span class="text-muted font-italic">Wert:</span> 
    			<?php echo $component->getComponentvalue()->getValue()?>
    		</p>
    	</li>
    </ul>
</div>