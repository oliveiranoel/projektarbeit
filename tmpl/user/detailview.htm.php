<?php

?>

<div class="card-body">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <p><span class="text-muted font-italic">Benutzer ID:</span> <?php echo $user->getUserid()?></p>
    	</li>
        <li class="list-group-item">
        	<p><span class="text-muted font-italic">Vorname:</span> <?php echo $user->getFirstname()?></p>
    	</li>
        <li class="list-group-item">
        	<p><span class="text-muted font-italic">Name:</span> <?php echo $user->getName()?></p>
    	</li>
        <li class="list-group-item">
        	<p><span class="text-muted font-italic">E-Mail Adresse:</span> <?php echo $user->getEmail()?></p>
    	</li>
        <li class="list-group-item">
        	<span class="text-muted font-italic">Passwort:</span>
        	<input type="password" style="border: none; background-color: white;" size="15" disabled value="<?php echo $user->getPassword()?>">
    	</li>
    </ul>
</div>