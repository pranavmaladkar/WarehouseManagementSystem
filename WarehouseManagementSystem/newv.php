

<?php
include("database.php");

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "UPDATE `vehicle_form` SET `val`='1' WHERE id=$id";
    $result = $conn->query($query);

    if($result == true){ 
        echo "Accepted";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

