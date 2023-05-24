<?php
$servername = "sql204.epizy.com";
$username = "epiz_34270296";
$password = "wYoOX1miYmVQXNa";
$dbname = "epiz_34270296_yoooot";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
