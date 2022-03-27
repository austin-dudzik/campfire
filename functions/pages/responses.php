<?php
// Start the DB connection
// Delete response from DB
if (isset($_POST["deleteSubmit"])) {
    $sql = "DELETE FROM responses WHERE id=$_POST[responseId]";
    if (mysqli_query($conn, $sql)) {
    }
}
?>
