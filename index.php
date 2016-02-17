<?php include_once("./views/home.html"); 

$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(new Herrera\Pdo\PdoServiceProvider(),
  array(
    'pdo.dsn' => 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"],
    'pdo.port' => $dbopts["port"],
    'pdo.username' => $dbopts["user"],
    'pdo.password' => $dbopts["pass"]
  )
);

$app->get('/db/', function() use($app) {
  $st = $app['pdo']->prepare('SELECT name FROM test_table');
  $st->execute();

  $names = array();
  while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['name']);
    $names[] = $row;
  }

  return $app['twig']->render('database.twig', array(
    'names' => $names
  ));
});


// Connecting, selecting database
//$dbconn = pg_connect("host=$dbopts["user"] dbname=publishing user=www password=foo")
//    or die('Could not connect: ' . pg_last_error());

// Performing SQL query
//$query = 'SELECT * FROM authors';
//$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
//echo "<table>\n";
//while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
//    echo "\t<tr>\n";
//    foreach ($line as $col_value) {
//        echo "\t\t<td>$col_value</td>\n";
//    }
//    echo "\t</tr>\n";
//}
//echo "</table>\n";

// Free resultset
//pg_free_result($result);

// Closing connection
//pg_close($dbconn);

?>
