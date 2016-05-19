<?php 
$dbconn = pg_connect(getenv('CONN_STRING'));

// $query1 = "CREATE TABLE members (
//   id SERIAL NOT NULL,
//   username varchar(100) NOT NULL,
//   password varchar(100) NOT NULL,
//   display_name varchar(100),
//   bio varchar(140),
//   gc_seals integer,
//   position integer,
//   created_at date,
//   updated_at date,
//   inactivation_date date,
//   PRIMARY KEY (id)
// );";

// $query2 = "CREATE OR REPLACE FUNCTION update_update_at_column()  
// RETURNS TRIGGER AS $$
// BEGIN
//     NEW.updated_at = now();
//     RETURN NEW; 
// END;
// $$ language 'plpgsql';";

// $query3 = "CREATE TRIGGER update_members_updated_at BEFORE UPDATE ON members FOR EACH ROW EXECUTE PROCEDURE update_update_at_column();";

// $query4 =  "CREATE OR REPLACE FUNCTION update_created_at_column()  
// RETURNS TRIGGER AS $$
// BEGIN
//     NEW.created_at = now();
//     RETURN NEW; 
// END;
// $$ language 'plpgsql';";

// $query5 = "CREATE TRIGGER update_members_created_at BEFORE INSERT ON members FOR EACH ROW EXECUTE PROCEDURE update_created_at_column();";

// $result1 = pg_query($dbconn, $query1);
// $result2 = pg_query($dbconn, $query2);
// $result3 = pg_query($dbconn, $query3);

// if ((!$result1) || (!$result2) || (!$result3)){
//   $message  = 'Invalid query: ';
//   die($message);
// }

$query = "select * from members;";
$result = pg_query($dbconn, $query);

$i = 0;

echo '<html><body><table><tr>';

while ($i < pg_num_fields($result))
{
  $fieldName = pg_field_name($result, $i);
  echo '<td>' . $fieldName . '<td>';
}
echo '</tr>';

$i = 0;

while ($row = pg_fetch_row($result)) 
{
  echo '<tr>';
  $count = count($row);
  $y = 0;
  while ($y < $count)
  {
    $c_row = current($row);
    echo '<td>' . $c_row . '</td>';
    next($row);
    $y = $y + 1;
  }
  echo '</tr>';
  $i = $i + 1;
}

pg_free_result($result);

echo '</table></body></html>';

pg_close($dbconn);

include_once("./views/home.html"); 
?>
