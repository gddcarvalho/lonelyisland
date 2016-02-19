<?php 
$dbconn = pg_connect(getenv('CONN_STRING'));
    if ($dbconn) {
        print "Successfully connected to: " . pg_host($dbconn) . "<br/>\n";
    } else {
        print pg_last_error($dbconn);
        exit;
    }

pg_close($dbconn);

if(!pg_close($dbconn)) {
        print "Failed to close connection to " . pg_host($dbconn) . ": " .
       pg_last_error($dbconn) . "<br/>\n";
    } else {
        print "Successfully disconnected from database";
    }

include_once("./views/home.html"); 
?>
