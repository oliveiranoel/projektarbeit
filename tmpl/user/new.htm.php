<?php

?>

<div class="wrapper">

<div>
    <h1>Neuer Benutzer</h1>
</div>

<form action="<?php echo $webroot?>users/new" method="post">
    <div class="form-group">
        <label for="firstname">Vorname</label>
        <input name="firstname" type="text" class="form-control" maxlength="35" placeholder="Max">
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" maxlength="50" placeholder="Muster">
    </div>
    <div class="form-group">
        <label for="email">E-Mail Adresse</label>
        <input name="email" type="email" class="form-control" placeholder="max.muster@domain.ch">
        <small class="form-text text-muted">E-Mail Adresse entspricht dem Benutzernamen.</small>
    </div>
    <div class="form-group">
        <label for="password">Passwort</label>
        <input name="password" type="password" class="form-control" maxlength="20" placeholder="Passwort">
    </div>
    <div class="form-group">
        <label for="admin">Rolle</label>
        <select class="form-control" name="admin">
                <option value="0" selected>Benutzer</option>
                <option value="1">Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
    <a class="btn btn-primary" href="<?php echo $webroot?>users">Abbrechen</a>
</form>

</div>