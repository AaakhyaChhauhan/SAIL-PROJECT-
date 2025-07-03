<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["regUsername"];
  $password = $_POST["regPassword"];

  if ($username && $password) {
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
      echo "<script>alert('✅ Registered Successfully'); window.location.href='index.html';</script>";
    } else {
      echo "<script>alert('❌ Registration failed or username taken'); window.location.href='index.html';</script>";
    }
  }
}
?>
