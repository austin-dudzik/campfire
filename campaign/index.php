<?php
// Include the init file
include "../functions/init.php";
// Redirect if not logged in
if (!logged_in()) {
    header("Location:../../login");
}
// Redirect to editor
header("Location:$url/campaign/$_GET[campaign]/editor");
?>
