<?php
session_start();
try {
    $conn = new PDO('mysql:host=localhost;port=8100;dbname=TheGrillSmith', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch (PDOException $exception) {
  echo "Oh no, there was a problem" . $exception->getMessage();
  }



  $reservationQuery= "SELECT * FROM Reservation";
  $reservation =$conn->query($reservationQuery);
  $reservationTable = $reservation->fetchAll();


  $_SESSION['reservation'] = $reservationTable;
