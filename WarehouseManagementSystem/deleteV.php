<?php
include("database.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM vehicle_form WHERE id = $id";
    $result = $conn->query($query);

    if($result == true){ 
        echo "Row deleted successfully.";
    } else {
        echo "Error deleting row: " . mysqli_error($conn);
    }
}
?>
