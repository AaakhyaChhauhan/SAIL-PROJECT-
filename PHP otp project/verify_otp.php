<?php
session_start();
include "db.php";

$username = $_SESSION['username'];
$enteredOtp = $_POST['otp'];

$stmt = $conn->prepare("SELECT * FROM otp_logs 
  WHERE username = ? AND otp = ? AND verified = 0 AND expires_at >= NOW()");
$stmt->bind_param("ss", $username, $enteredOtp);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // ✅ Mark OTP as verified
  $update = $conn->prepare("UPDATE otp_logs SET verified = 1 WHERE username = ? AND otp = ?");
  $update->bind_param("ss", $username, $enteredOtp);
  $update->execute();

  echo "<script>alert('✅ OTP verified successfully!'); window.location.href='dashboard.html';</script>";
} else {
  echo "<script>alert('❌ Invalid or expired OTP'); window.location.href='otp.html';</script>";
}
?>
