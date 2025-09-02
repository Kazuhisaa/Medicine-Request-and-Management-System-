<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
  include '../config/db.php';

  $email = $_POST['email'];

  $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    $token = bin2hex(random_bytes(50));
    $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));


    $update = $conn->prepare("UPDATE users SET reset_token =?, reset_expires =? WHERE email =?");
    $update->bind_param("sss", $token, $expires, $email);
    $update->execute();

    $resetLink = "http://medrms.test/newpass.php?token=" . $token;

    $mail = new PHPMailer(true);

    try {
      $mail->SMTPDebug = 2;
      $mail->Debugoutput = 'html';


      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'noreplyMedrms35@gmail.com';
      $mail->Password = 'kqyi yioi ojqg glnm';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->MessageID = '<' . md5(uniqid(time())) . '@gmail.com>';

      $mail->setFrom('noreplyMedrms35@gmail.com', 'medrms');
      $mail->addAddress($email);

      $mail->Subject = 'Password Reset Request';
      $mail->Body = "Hi, \n\nPlease Click the Link below to reset your password:\n$resetLink\n\n This link will expire after 1 hour.";
      $mail->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
