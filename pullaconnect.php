<?php
$host = 'db';

$dbname = 'pulladb'; // database name 

$dbuser = 'root';

$dbpass = 'lionPass';


// Two ways to connect to database: 1. PDO and 2. MySQLI

$connection = new mysqli($host, $dbuser, $dbpass, $dbname);

if ($connection->connect_error) {
die("connection failed" .$connection->connect_error);
}
?>