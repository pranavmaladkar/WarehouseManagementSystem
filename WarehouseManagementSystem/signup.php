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

// Check if the registration form was submitted
if (isset($_POST['submit'])) {
    // Sanitize the entered username and password
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepare a SQL query to insert the new user's information into the database
    $query = "INSERT INTO users (username, upassword) VALUES ('$username', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Registration successful
        header("Location: signUpSuccess.html"); // redirect to success.html
    } else {
        // Registration failed
        header("Location: signUpFailed.html");
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);

?>
