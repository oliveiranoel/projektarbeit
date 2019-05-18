<?php

$object = Provider::getUser( $userid );
?>

<div class="wrapper">

<div>
    <h1><?php echo $object->getFirstname() . " " . $object->getName() ?></h1>
</div>

<form action="<?php echo $webroot?>users/<?php echo $object->getUserid()?>/edit" method="post">
	<div class="form-group">
        <label for="firstname">Vorname</label>
        <input name="firstname" type="text" class="form-control" value="<?php echo $object->getFirstname()?>">
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" value="<?php echo $object->getName()?>">
    </div>
    <div class="form-group">
        <label for="email">E-Mail Adresse</label>
        <input name="email" type="email" class="form-control" value="<?php echo $object->getEmail()?>">
        <small class="form-text text-muted">E-Mail Adresse entspricht dem Benutzernamen.</small>
    </div>
    <div class="form-group">
        <label for="password">Passwort</label>
        <input name="password" type="password" class="form-control" value="<?php echo $object->getPassword()?>">
    </div>
    <div class="form-group">
        <label for="admin">Rolle</label>
        <select class="form-control" name="admin">
                <option value="0" <?php if ( $object->getRole() == "Benutzer" ) echo "selected" ?>>Benutzer</option>
                <option value="1" <?php if ( $object->getRole() == "Admin" ) echo "selected" ?>>Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>users">Abbrechen</a>
</form>

</div>
