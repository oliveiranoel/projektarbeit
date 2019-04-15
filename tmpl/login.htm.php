<?php 

?>

<!-- TODO: if user data is wrong, refuse sending form -->
<form class="form-login text-center" action="<?php echo $webroot?>login.html" method="post">
	<img class="mb-4" src="<?php echo $webroot?>img/bootstrap-solid.svg"
		alt="" width="72" height="72">
	<h1 class="h3 mb-3 font-weight-normal">Please log in</h1>
	
	<label for="inputEmail" class="sr-only">Email address</label>
	<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
	
	<label for="inputPassword" class="sr-only">Password</label> 
	<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
	
	<button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Log in</button>
	<p class="mt-5 mb-3 text-muted">&copy; 2019</p>
</form>
