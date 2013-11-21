<?php

// Localhost
// $dbname = "chars";
// $dbuser = "root";
// $dbpass = "";
// $dbhost = "localhost";

// Edumedia.ca
 $dbname = "rayn0021";
 $dbuser = "rayn0021";
 $dbpass = "40628090";
 $dbhost = "localhost";

$pdo = new PDO("mysql:host=". $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass );

?>