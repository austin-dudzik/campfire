<?php
// Start the DB connection
// If form is submitted...
if (isset($_POST["submit"])) {
    // Disable errors for empty inputs
    error_reporting(0);
    // Connect to the database
    $widgetPrivacy = $_POST["privacy"];
    $sql = "UPDATE campaigns SET privacy='$widgetPrivacy' WHERE id=$_GET[campaign]";
    if ($conn->query($sql) === TRUE) {
    }
    // Close the connection
    $conn->close();
}
?>
