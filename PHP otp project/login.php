<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["loginUsername"];
  $password = $_POST["loginPassword"];

  // Step 1: Authenticate user
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // ✅ Step 2: Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['username'] = $username;
    $_SESSION['otp'] = $otp;

    // ✅ Step 3: Get user's mobile (for now, hardcoded or use from DB)
    $mobile = "9876543210"; // Replace with actual or fetch from DB

    // ✅ Step 4: Save OTP in DB
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));
    $stmt2 = $conn->prepare("INSERT INTO otp_logs (username, mobile, otp, expires_at) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("ssss", $username, $mobile, $otp, $expiry);
    $stmt2->execute();

    // ✅ Step 5: Send OTP via Fast2SMS
    $apiKey = "YOUR_FAST2SMS_API_KEY"; // 🔑 Replace this

    $data = [
      "sender_id" => "FSTSMS",
      "message" => "Your OTP is $otp",
      "language" => "english",
      "route" => "otp",
      "numbers" => $mobile,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => [
        "authorization: $apiKey",
        "accept: */*",
        "cache-control: no-cache",
        "content-type: application/json"
      ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      echo "<script>alert('OTP created but SMS failed'); window.location.href='otp.html';</script>";
    } else {
      echo "<script>alert('OTP sent via SMS'); window.location.href='otp.html';</script>";
    }

  } else {
    echo "<script>alert('❌ Invalid credentials'); window.location.href='index.html';</script>";
  }
}
?>
