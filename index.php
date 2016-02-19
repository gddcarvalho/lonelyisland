<?php 
$dbconn = pg_connect(getenv('CONN_STRING'));

$query1 = "CREATE TABLE members (
  id SERIAL NOT NULL,
  username varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  gc_seals integer,
  position integer,
  created_at date,
  updated_at date,
  inactivation_date date,
  PRIMARY KEY (id)
);";

$query2 = "CREATE TRIGGER trUserCreationDate ON members
  FOR INSERT 
  AS
  UPDATE members SET members.created_at=getdate()
  FROM members INNER JOIN Inserted ON members.id= Inserted.id";

$query3 = "CREATE TRIGGER trUserUpdateDate ON members
  FOR UPDATE 
  AS
  UPDATE members SET members.updated_at=getdate()
  FROM members INNER JOIN Inserted ON members.id= Inserted.id";


$result1 = pg_query($dbconn, $query1);
$result2 = pg_query($dbconn, $query2);
$result3 = pg_query($dbconn, $query3);

if ((!$result1) || (!$result2) || (!$result3))_ {
  $message  = 'Invalid query: ' . "\n";
  $message .= 'Whole query: ' . $query;
  die($message);
};

pg_close($dbconn);

include_once("./views/home.html"); 
?>
