<?php
use php\Provider;

$user = Provider::getUser( $userid );
?>

<div class="wrapper">

<div>
    <h1><?php echo $user->getFirstname() . " " . $user->getName() ?></h1>
</div>

<form action="<?php echo $webroot?>users/<?php echo $user->getUserid()?>/edit" method="post">
	<div class="form-group">
        <label for="userid">Benutzer ID</label>
        <input name="userid" type="text" class="form-control" value="<?php echo $user->getUserid()?>" readonly>
    </div>
	<div class="form-group">
        <label for="firstname">Vorname</label>
        <input name="firstname" type="text" class="form-control" value="<?php echo $user->getFirstname()?>">
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" value="<?php echo $user->getName()?>">
    </div>
    <div class="form-group">
        <label for="email">E-Mail Adresse</label>
        <input name="email" type="email" class="form-control" value="<?php echo $user->getEmail()?>">
        <small class="form-text text-muted">E-Mail Adresse entspricht dem Benutzernamen.</small>
    </div>
    <div class="form-group">
        <label for="password">Passwort</label>
        <input name="password" type="password" class="form-control" value="<?php echo $user->getPassword()?>">
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>users">Abbrechen</a>
</form>

</div>
