<?php

use PHPMailer\PHPMailer\PHPMailer;

class ErrorQuery
{
    // Properties
    public $key;
    public $value;

    // Constructor
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}


function attachErrorsToURL($navigateUrl, $errors)
{
    // Append errors as query parameters
    if (!empty($errors)) {
        $navigateUrl .= (strpos($navigateUrl, '?') === false) ? '?' : '&';
        foreach ($errors as $error) {
            
            $navigateUrl .= urlencode($error->key) . '=' . urlencode($error->value) . '&';
        }
        // Remove the trailing '&' character
        $navigateUrl = rtrim($navigateUrl, '&');
    }

    return $navigateUrl;
}

// check if it's from post request
if (isset($_POST["full_name"])) {

    // store incoming data in corresponding variables
    $receiverMail = $_POST['google_mail'];
    $email = $_POST["email"];
    $full_name = $_POST['full_name'];
    $subject = $_POST['subject'];

    $full_name_err = $subject_err = $email_err = $message_err = "";

    $error_queries = [];

    if (empty(trim(($full_name)))) {
        array_push($error_queries, new ErrorQuery("full_name_err", "Please enter your full name"));
    }

    if (empty(trim($email))) {
        array_push($error_queries, new ErrorQuery("email_err", "Please enter your email"));
    }

    if (empty(trim(($subject_err)))) {
        array_push($error_queries, new ErrorQuery("subject_err", "Please enter the subject"));
    }

    if (empty(trim(($_POST['message'])))) {
        array_push($error_queries, new ErrorQuery("message_err", "Please enter the message"));
    }


    if (!empty($error_queries)) {
        $url = attachErrorsToURL("../contact.php", $error_queries);

        header('Location: ' . $url);
        exit();
    } else {
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
}
