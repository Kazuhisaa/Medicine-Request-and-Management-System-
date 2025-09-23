<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../config/db.php';

// Get POST values safely
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$status = isset($_POST['status']) ? trim($_POST['status']) : '';

if (!$id || !$status) {
  echo json_encode(['success' => false, 'message' => 'Invalid ID or status']);
  exit;
}

// Only allow certain statuses
$allowed = ['Pending', 'Accepted', 'Rejected'];
if (!in_array($status, $allowed)) {
  echo json_encode(['success' => false, 'message' => 'Invalid status value']);
  exit;
}

// Update DB
$stmt = $conn->prepare("UPDATE requests SET status=? WHERE id=?");
$stmt->bind_param("si", $status, $id);
$success = $stmt->execute();
$stmt->close();

// Send email if accepted
if ($success && $status === 'Accepted') {
  $userQuery = $conn->prepare("
        SELECT u.email, CONCAT(u.fname,' ',u.lname) AS full_name
        FROM users u
        JOIN requests r ON u.id = r.user_id
        WHERE r.id=?
    ");
  $userQuery->bind_param("i", $id);
  $userQuery->execute();
  $result = $userQuery->get_result();
  $user = $result->fetch_assoc();
  $userQuery->close();

  if ($user) {
    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'noreplymedrms35@gmail.com';
      $mail->Password = 'okax zahi qbys ynaz'; // Make sure to use app password if Gmail
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      $mail->setFrom('noreplymedrms35@gmail.com', 'Botika ng Barangay 35');
      $mail->addAddress($user['email'], $user['full_name']);
      $mail->Subject = 'Medicine Request Accepted';
      $mail->Body = "Hello " . $user['full_name'] . ",\n\nYour medicine request has been accepted.\n\n Please get your medicine at the Botika ng Barangay 35 \n\n Time: 8:00am - 5:00pm \n\nThank you!";

      $mail->send();
    } catch (Exception $e) {
      // Optional: log error to debug
      error_log("PHPMailer Error: " . $mail->ErrorInfo);
    }
  }
}

echo json_encode(['success' => $success]);
exit;
