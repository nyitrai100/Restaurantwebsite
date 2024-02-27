<?php
use PHPMailer\PHPMailer\PHPMailer;

// check if it's from post request
if (isset($_POST["full_name"])) {

    // store incoming data in corresponding variables
    $receiverMail = $_POST['google_mail'];
    $email = $_POST["email"];
    $full_name = $_POST['full_name'];
    $subject = $_POST['subject'];
    $message = "Name: " . $full_name . "\n\nEmail: " . $email . "\n\nMessage: " . $_POST['message'];

    // import all required library files
    require_once "./PHPMailer/PHPMailer.php";
    require_once "./PHPMailer/SMTP.php";
    require_once "./PHPMailer/Exception.php";

    $mail = new PHPMailer();

    // setting up http settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Port = 465;

    // ensure that the following credentials are not made public. Later, will be stored in .env file.
    $mail->Username = $receiverMail;
    $mail->Password = $_POST['google_passkey'];

    $mail->SMTPSecure = 'ssl';

    // lay out data to be send via email
    $mail->setFrom($email);
    $mail->addAddress($receiverMail);

    $mail->Subject = $subject;
    $mail->Body = $message;

    // check if the email has been sent successfully and show response accordingly
    if ($mail->send()) {
        header("Location: ../contact-thank-you.php");
    } else {
        echo "<h1>Something went wrong!</h1>";
    }

}
?>