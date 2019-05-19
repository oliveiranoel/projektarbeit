
<div class="card-body">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <p><span class="text-muted font-italic">Raum ID:</span> <?php echo $room->getRoomId()?></p>
    	</li>
        <li class="list-group-item">
        	<p><span class="text-muted font-italic">Nummer</span> <?php echo $room->getNumber()?></p>
    	</li>
        <li class="list-group-item">
        	<p><span class="text-muted font-italic">Beschreibung:</span> <?php echo $room->getDescription()?></p>
    	</li>
    </ul>
</div>