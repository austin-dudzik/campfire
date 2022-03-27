<?php
// Delete response from DB
if (isset($_POST["deleteSubmit"])) {
    $stmt = $conn->prepare("DELETE FROM responses WHERE id=?");
    $stmt->bind_param('s', $_POST["responseId"]);
    $stmt->execute();
}