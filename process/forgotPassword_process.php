<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../config/db.php';

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);

    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Delete old tokens for this email
        $delete = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
        $delete->bind_param("s", $email);
        $delete->execute();

        // Generate new token
        $Tokens = bin2hex(random_bytes(32));
        $hashTokens = hash('sha256', $Tokens);

        date_default_timezone_set('Asia/Manila');
        $expire = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Insert into password_resets
        $insert = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?,?,?)");
        $insert->bind_param("sss", $email, $hashTokens, $expire);
        $insert->execute();

        // Reset link
        $resetLink = 'http://localhost/sample/Medicine-Request-and-Management-System-/newpass.php?token=' . $Tokens;

        // Send email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreplymedrms35@gmail.com';
            $mail->Password = 'okax zahi qbys ynaz';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('noreplymedrms35@gmail.com', 'medrms');
            $mail->addAddress($email);
            $mail->Subject = 'Password Reset';
            $mail->Body = "Hi, \n\nClick the link below to reset your password:\n\n$resetLink\n\nThis link is only valid for 1 hour.";

            $mail->send();

            // Redirect to success page with masked email
            header("Location: ../success.php?email=" . urlencode($email));
            exit;

        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        // If no account with that email
        header("Location: ../forgotpassword.php?error=notfound");
        exit;
    }
}
