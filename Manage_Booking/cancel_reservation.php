<?php
try {
    $conn = new PDO('mysql:host=localhost;port=3306;dbname=thegrillsmith', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Oh no, there was a problem" . $exception->getMessage();
}

if (isset($_POST["reserveId"])) {

    try{
    $reserveId = $_POST["reserveId"];
    echo $reserveId;
    $deleteTableQuery = "DELETE FROM Reservation WHERE Id = :reId";
    $stmt = $conn->prepare($deleteTableQuery);
    $stmt->bindParam(':reId', $reserveId, PDO::PARAM_INT);
    $stmt->execute();

    $stmt->debugDumpParams();
    // if($stmt->execute()) {
    //     echo "<script type='text/javascript'>alert('Reservation with id: $reserveId has been cancelled.');</script>";
    // } else {
    //     echo "<h1> Something went wrong! </h1>";
    // }
    } catch (PDOException $e) {
        // Log or display the error message
        echo "Error: " . $e->getMessage();
    }

    header("Location: ../reservation.php");
} else {
    echo "<h1> Something went wrong! </h1>";
}

?>
