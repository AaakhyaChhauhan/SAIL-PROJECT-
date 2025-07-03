<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "sql12.freesqldatabase.com";     // e.g., sql4.freesqldatabase.com
$user = "sql12787890"; // e.g., sql44999X
$pass = "Please wait";
$db   = "sql12787890"; // same as username usually

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Connected to the database successfully!";
}
?>
