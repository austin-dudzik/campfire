<?php
// If profile form is submitted...
if (isset($_POST["save"])) {
    // Disable errors for empty inputs
    error_reporting(0);
    // Connect to the database
    $firstName = $conn->real_escape_string($_POST["first"]);
    $lastName = $conn->real_escape_string($_POST["last"]);
    $emailAddress = $conn->real_escape_string($_POST["email"]);
    $sql = "UPDATE users SET first_name='$firstName', last_name='$lastName', email='$emailAddress' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        header("Location:logout.php");
    }
    // Close the connection
    $conn->close();
}
// If password form is submitted...
if (isset($_POST["changePassword"])) {
    // Connect to the database
    // Disable errors for empty inputs
    error_reporting(0);
    $newPassword = $conn->real_escape_string(password_hash($_POST["newPassword"], PASSWORD_BCRYPT));
    $sql = "UPDATE users SET password='$newPassword' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        header("Location:logout.php");
    }
    // Close the connection
    $conn->close();
}
