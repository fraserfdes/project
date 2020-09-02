<?php
include "connection.php";
$id=$_REQUEST['book_id'];  
$sql ="DELETE FROM `books` WHERE `books`.`book_id` =$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  
mysqli_close($conn);
?>