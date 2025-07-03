
<?php
$host = "sql12.freesqldatabase.com";
$user = "sql12787890";
$pass = "ZMLhL9LGUN";
$db = "sql12787890";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
