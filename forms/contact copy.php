<?php
//     use PHPMailer\PHPMailer\Exception;
//     use PHPMailer\PHPMailer\PHPMailer;
//     use PHPMailer\PHPMailer\SMTP;

//     require '../vendor/autoload.php';

//     $mail = new PHPMailer(true);

//     try {

//         $mail->isSMTP();                     
//         $mail->Host       = 'smtp.gmail.com';
//         $mail->SMTPAuth   = true;
//         $mail->Username   = 'jitendrashekhawat2529@gmail.com';
//         $mail->Password   = 'glusfkjjpoyhuqsq';
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//         $mail->Port       = 465;

//         $mail->setFrom('jitendrashekhawat2529@gmail.com', 'Mailer');
//         $mail->addAddress('jitendrashekhawat2529@gmail.com', 'Joe User');

//         $mail->isHTML(true); 
//         $mail->Subject = 'Here is the subject';
//         $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//         $mail->send();
//         echo 'Message has been sent';
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = nl2br(htmlspecialchars($_POST['message'])); // preserve line breaks

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                     
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jitendrashekhawat2529@gmail.com';  // your Gmail
        $mail->Password   = 'glusfkjjpoyhuqsq';                 // app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom($email, $name);  // From user
        $mail->addAddress('jitendrashekhawat2529@gmail.com', 'Your Name'); // To yourself

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";
        $mail->AltBody = "Name: {$name}\nEmail: {$email}\nSubject: {$subject}\nMessage:\n{$message}";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}

?>