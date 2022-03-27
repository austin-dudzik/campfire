<?php
// Set the access-control header
header("Access-Control-Allow-Origin: *");
// Include the init file
include("../functions/init.php");
// If form has been submitted
if (isset($_POST['campaign'])) {

    $stmt = $conn->prepare("SELECT tyTitle, tyMessage, privacy FROM campaigns WHERE id = ?");
    $stmt->bind_param("i", $_POST['campaignId']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $widgetTyTitle = clean($row["tyTitle"]);
            $widgetTyMessage = clean($row["tyMessage"]);
            $widgetPrivacy = clean($row["privacy"]);
        }
    }

    // Set the variables
    $email = $widgetPrivacy == "1" ? (isset($_POST["email"]) ? $_POST["email"] : "") : "";
    $ip = $widgetPrivacy == "1" ? $_SERVER['REMOTE_ADDR'] : "";


    $stmt = $conn->prepare("INSERT INTO responses (campaignId, email, message, rate, ip, created) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param('issis', $_POST["campaignId"], $email, $_POST["message"], $_POST["rate"], $ip);
    $stmt->execute();

    if ($stmt->affected_rows > 0) { ?>
        <div class='lw-title lw-title_lg lw-center'
             style='margin-top:.5em;margin-bottom:.5em'><?= $widgetTyTitle ?></div>
        <div class='lw-content lw-center lw-mb'><?= $widgetTyMessage ?></div>
    <?php } else { ?>
        <div class='lw-title lw-title_lg lw-center" style="margin-top:.5em;margin-bottom:.5em'>
            An error has occurred.
        </div>
        <div class='lw-content lw-center lw-mb'>Please refresh the page and try again.</div>
        <a href='' class='lw-btn lw-btn_wide'>
            <i class='far fa-sync-alt' style='margin-right:5px'></i> Reload
        </a>
    <?php }
} else {
    die('Access Denied');
} ?>
