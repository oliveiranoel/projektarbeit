<?php
use php\ModelFactory;

?>

<main role="main" class="container">
<div>
	<h1>Overview</h1>
</div>

<div id="accordion">


	<?php foreach (ModelFactory::getInstance()->mapToRoomObject() as $room) { ?>
	
	<div class="card">
		<div class="card-header" id="heading<?php echo $room->getRoomId()?>">
			<h5 class="mb-0">
				<button class="btn btn-link" data-toggle="collapse"
					data-target="#collapse<?php echo $room->getRoomId()?>" aria-expanded="true"
					aria-controls="collapse<?php echo $room->getRoomId()?>"> <?php echo $room->getDescription() ?> </button>
			</h5>
		</div>
		<div id="collapse<?php echo $room->getRoomId()?>" class="collapse"
			aria-labelledby="heading<?php echo $room->getRoomId()?>" data-parent="#accordion">
			<div class="card-body"> <?php echo $room->getNumber() ?></div>
		</div>
	</div>
	    
    <?php } ?>

</div>
</main>