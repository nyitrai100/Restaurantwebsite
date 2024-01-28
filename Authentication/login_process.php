<?php
session_start();

try {
    $conn = new PDO('mysql:host=localhost;port=8100;dbname=restaurant-TeamProject', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Oh no, there was a problem" . $exception->getMessage();
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../index.php?error=emptyfield");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM User WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    if ($row = $stmt->fetch()) {
        if ($password === $row['password']) {
            // Plain text password comparison
            $_SESSION["user"] = $email;
            header("Location: ../index.php");
            exit();
        }
    }

    echo "<script>alert('That\'s the wrong username/password');</script>";
    echo "<script>window.location.href = '../index.php';</script>";
    exit;
}

$conn = NULL;
?>
