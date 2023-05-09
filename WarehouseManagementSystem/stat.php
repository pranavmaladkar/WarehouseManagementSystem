<?php
include("database.php");

$mobileNo = $_POST['mobileNo'];
$orderType = $_POST['orderType'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($orderType == "storage") {
    $table = "storage_form";
} elseif ($orderType == "vehicle") {
    $table = "vehicle_form";
} else {
    echo "Please select the order type.";
    exit;
}

$sql1 = "SELECT * FROM $table WHERE contact_number='$mobileNo' and val='0'";
$result1 = $conn->query($sql1);
$sql = "SELECT * FROM $table WHERE contact_number='$mobileNo' and val='1'";
$result = $conn->query($sql);
if($result1->num_rows > 0)
{
    header("Location: os.html");
}
elseif($result->num_rows > 0) {
    header("Location: oss.html");
} else {
    header("Location: ous.html");
}

$conn->close();

?>
