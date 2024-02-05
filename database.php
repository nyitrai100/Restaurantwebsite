
<?php
try {
    $conn = new PDO('mysql:host=localhost;port=3306;dbname=thegrillsmith', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch (PDOException $exception) {
  echo "Oh no, there was a problem" . $exception->getMessage();
  }



// connect the reservation table, Restaurant Table, Branch table together
if(isset($_SESSION["user_id"])){
  $userID = $_SESSION["user_id"];}
  $reservationRestaurantTableBranch = "SELECT * FROM Reservation
                                       JOIN  RestaurantTable ON Reservation.table_id=RestaurantTable.id 
                                       JOIN Branch ON RestaurantTable.branch_id=Branch.id
                                       JOIN User ON Branch.user_id = User.id
                                       WHERE User.id = :userID";

$stmt = $conn->prepare($reservationRestaurantTableBranch);
$stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
$stmt->execute();
$reservationRBS = $stmt->fetchAll();
  $_SESSION['reservationRBS'] = $reservationRBS;




// Branch table for the booking-dropdown-form
$branchTable = "SELECT * FROM Branch";
$stmt = $conn->prepare($branchTable);
$stmt->execute();
$BranchNames = $stmt->fetchAll();
$_SESSION['BranchNames'] = $BranchNames;