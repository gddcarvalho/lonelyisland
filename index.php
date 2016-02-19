<?php 
$dbconn = pg_connect(getenv('CONN_STRING'));
   or die("Could not connect");
echo "Connected successfully";
pg_close($dbconn);

include_once("./views/home.html"); 
?>
