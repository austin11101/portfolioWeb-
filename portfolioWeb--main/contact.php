<?php
require 'vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send'])) { // Correctly checking for the 'send' button
    $email = new PHPMailer(true);

    try {
        $email->isSMTP();
        $email->Host = 'smtp.*****.com';
        $email->SMTPAuth = true;
        $email->Username = 'austin****@gmail.com'; // Your Gmail address
        $email->Password = '*******'; // Your Gmail password (ensure you've allowed less secure apps in Gmail settings)
        $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $email->Port = 587;

        // Sender info
        $email->setFrom('austin****@gmail.com', 'Muxe');

        // Recipient info
        $email->addAddress($_POST['email']);
        $email->isHTML(true);

        // Email content
        $email->Subject = $_POST['subject'];
        $email->Body = $_POST['Message'];

        $email->send();

        echo "<script>
                alert('Sent Successfully');
                window.location.href = 'index.php';
              </script>";
    } catch (Exception $e) {
        echo "<script>
                alert('Message could not be sent. Mailer Error: {$email->ErrorInfo}');
                window.location.href = 'index.php';
              </script>";
    }
}
