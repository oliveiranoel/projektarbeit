<?php

$objects = Provider::getUsers();

?>

<div class="wrapper">

<div>
	<h1>
		Benutzer
		<a href="<?php echo $webroot?>users/new">
			<span class="glyphicon glyphicon-plus ml-3" style="font-size: .8em;"></span>
		</a>
	</h1>
</div>

<table id="table_id" class="display">
    <thead>
        <tr>
            <th></th>
            <th>Benutzer</th>
            <th>Tools</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    foreach ( $objects as $user )
    {
    ?>
        <tr>
        	<td class=" details-control"></td>
            <td><?php echo $user->getFirstname()?></td>
            <td>
            	<div class="btn-toolbar float-right" role="toolbar">
                    <div class="btn-group mr-2" role="group">
    					<a class="btn btn-primary" href="<?php echo $webroot?>users/<?php echo $user->getUserid()?>/edit" role="button">
                        	<span class="glyphicon glyphicon-pencil"></span>
						</a>
                    </div>
                    <div class="btn-group mr-2" role="group">
                    	<form action="<?php echo $webroot?>users/<?php echo $user->getUserid()?>/delete" method="post">
                    		<button type="submit" class="btn btn-primary">
                    			<span class="glyphicon glyphicon-trash"></span>
							</button>
                    	</form>
                    </div>
				</div>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
</div>
