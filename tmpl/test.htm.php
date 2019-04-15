<?php
use php\util\DBUtil;
use php\util\QueryUtil;

$obj = QueryUtil::query( "SELECT * FROM object", DBUtil::getConnection() );
$obj = QueryUtil::execute( "DELETE FROM object WHERE objectid = 2", DBUtil::getConnection() );
?>

<main role="main" class="container">
<div
	class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
	<img class="mr-3" src="<?php echo $webroot?>img/bootstrap-outline.svg" alt="" width="48"
		height="48">
	<div class="lh-100">
		<h6 class="mb-0 text-white lh-100">Bootstrap</h6>
		<small>Since 2011</small>
	</div>
</div>

<div>
	<h1>Test</h1>
    <ul>
    	<li><a href="/projektarbeit/home">home</a></li>
    	<li><a href="/projektarbeit/template.html">template.html</a></li>
    	<li><a href="/projektarbeit/test.html">test.html</a></li>
    	<li><a href="/projektarbeit/login.html">login.html</a></li>
    	<li><a href="/projektarbeit/users">users</a></li>
    	<li><a href="/projektarbeit/users/1">user</a></li>
    	<li><a href="/projektarbeit/users/1/edit">user edit</a></li>
    	
    	<br/>
    	
    	<li><a href="/projektarbeit/index.php">index.php</a></li>
    	<li><a href="/projektarbeit/contact-form/">contact form</a></li>
    	<li><a href="/projektarbeit/get-post-sample">get+post example</a></li>
    	<li><a href="/projektarbeit/this-route-is-not-defined">404 Test</a></li>
    	<li><a href="/projektarbeit/this-route-is-defined">405 Test</a></li>
	</ul>

	<p><?php var_dump( $_SESSION[ "data" ][ "users" ] )?></p>
	<br>
	<p><?php var_dump( $obj )?></p>
</div>
</main>