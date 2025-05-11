<?php
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Form</title>
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name    = htmlspecialchars($_POST['name']);
        $email   = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = nl2br(htmlspecialchars($_POST['message'])); // preserve line breaks

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jitendrashekhawat2529@gmail.com';
            $mail->Password   = 'glusfkjjpoyhuqsq';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom($email, $name);
            $mail->addAddress('jitendrashekhawat2529@gmail.com', 'Your Name');

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

            // SweetAlert + redirect to index.php
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Message Sent!',
                text: 'Your message has been successfully sent.'
            }).then(() => {
             window.history.back();
             setTimeout(function() {
                    window.location.reload();
                }, 1000);
            });
        </script>";

        } catch (Exception $e) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Send Failed!',
                text: 'Mailer Error: " . addslashes($mail->ErrorInfo) . "'
            }).then(() => {
               window.history.back();
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            });
        </script>";
        }
    }
?>

</body>
</html>
