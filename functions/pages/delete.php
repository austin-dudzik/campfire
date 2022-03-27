<?php
// Start the DB connection
// Delete response from DB
if (isset($_POST["deleteSubmit"])) {
    $sql = "DELETE FROM campaigns WHERE id=$_GET[campaign]";
    if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM responses WHERE campaignId=$_GET[campaign]";
        if (mysqli_query($conn, $sql)) {
            header("Location:$url");
        }
    }
}
?>
