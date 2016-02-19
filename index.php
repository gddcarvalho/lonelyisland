<?php 
$dbconn = pg_connect(getenv('CONN_STRING'));

$query = sprintf("CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` date,
  `updated_at` date,
  `inactivation_date` date,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

$query .= "CREATE TRIGGER trUserCreationDate ON user
  FOR INSERT 
  AS
  UPDATE user SET user.created_at=getdate()
  FROM user INNER JOIN Inserted ON user.id= Inserted.id"

$query .= "CREATE TRIGGER trUserUpdateDate ON user
  FOR UPDATE 
  AS
  UPDATE user SET user.updated_at=getdate()
  FROM user INNER JOIN Inserted ON user.id= Inserted.id"


$result = pg_query($dbconn, $query);

if (!$result) {
  $message  = 'Invalid query: ' . "\n";
  $message .= 'Whole query: ' . $query;
  die($message);
}

pg_close($dbconn);

include_once("./views/home.html"); 
?>
