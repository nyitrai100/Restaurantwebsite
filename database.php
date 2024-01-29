<?php

try {
    $conn = new PDO('mysql:host=localhost;port=8100;dbname=restaurant-TeamProject', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch (PDOException $exception) {
  echo "Oh no, there was a problem" . $exception->getMessage();
  }
  
  