<?php

// Establish a connection to the MySQL database
$host = "localhost";
$username = "root";
$password = "";
$database = "inventory2";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the login form was submitted
if (isset($_POST['submit'])) {
    // Sanitize the entered username and password
    $Username = mysqli_real_escape_string($conn, $_POST['username']);
    $Password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepare a SQL query to select the user's information from the database based on the entered username
    $query = "SELECT * FROM users WHERE username='$Username' and upassword = '$Password'";
    $stmt = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($stmt);

    if ($stmt === false) {
        die("Error preparing query: " . mysqli_error($conn));
    }
    if($count == 1){
        echo readfile('./adminPage.html');
    }
    else{
        header("Location: failed.html"); // redirect to success.html
    }
}

// Close the database connection
mysqli_close($conn);
?>
