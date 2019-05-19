
<div class="wrapper">

<form class="form-login text-center" action="<?php echo $webroot?>login.html" method="post">
    <span class="glyphicon glyphicon-lock mb-3" style="font-size: 1.5em"></span>
	<h1 class="h3 mb-3 font-weight-normal">Anmelden</h1>
	
	<label for="inputEmail" class="sr-only">E-Mail Adresse</label>
	<input name="email" type="email" id="inputEmail" class="form-control" placeholder="E-Mail Adresse" required autofocus>
      
	<label for="inputPassword" class="sr-only">Passwort</label> 
	<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Passwort" required>
	<div class="invalid-feedback">
		Benutzername oder Passwort ist falsch!
	</div>
      
	<button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Log in</button>
	<p class="mt-5 mb-3 text-muted">&copy; 2019</p>
</form>

</div>
