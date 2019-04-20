<?php
use php\util\DBUtil;
use php\util\QueryUtil;

$obj = QueryUtil::execute( "DELETE FROM object WHERE objectid = 2", DBUtil::getConnection() );
$obj = QueryUtil::query( "SELECT * FROM object", DBUtil::getConnection() );
?>

<div class="wrapper">

<h1>Test</h1>
<div class="list-group">
    <a class="list-group-item list-group-item-action active" href="/projektarbeit/home">Home</a>
    <a class="list-group-item list-group-item-action" href="/projektarbeit/test.html">test.html</a>
    
    <a class="list-group-item list-group-item-action" href="/projektarbeit/login.html">login.html</a>
    <a class="list-group-item list-group-item-action" href="/projektarbeit/users">users</a>
    <a class="list-group-item list-group-item-action" href="/projektarbeit/users/1/edit">user edit</a>
    <a class="list-group-item list-group-item-action" href="/projektarbeit/overview">overview</a>
    <a class="list-group-item list-group-item-action" href="/projektarbeit/index.php">index.php</a>
</div>

</div>
