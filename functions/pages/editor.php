<?php

include "../../functions/init.php";

// If form is submitted...
if (isset($_POST["submit"])) {
    // Disable errors for empty inputs
    error_reporting(0);
    // Connect to the database
    $widgetName = escape($_POST["name"]);
    $widgetTitle = escape($_POST["title"]);
    $widgetSubtitle = escape($_POST["subtitle"]);
    $widgetRating = escape($_POST["rating"]);
    $widgetEmailField = escape($_POST["emailField"]);
    $widgetAccent = escape($_POST["accent"]);
    $widgetType = escape($_POST["type"]);
    $widgetPosition = escape($_POST["position"]);
    $widgetButtonText = escape($_POST["buttonText"]);
    $widgetTyTitle = escape($_POST["tyTitle"]);
    $widgetTyMessage = escape($_POST["tyMessage"]);
    $widgetPrivacy = escape($_POST["privacy"]);
    $widgetDate = escape(date("F j, Y"));
    $sql = "UPDATE campaigns SET name='$widgetName', title='$widgetTitle', subtitle='$widgetSubtitle', rating='$widgetRating', emailField='$widgetEmailField', accent='$widgetAccent', position='$widgetPosition', type='$widgetType', buttonText='$widgetButtonText', tyTitle='$widgetTyTitle', tyMessage='$widgetTyMessage', privacy='$widgetPrivacy' WHERE id=$_POST[submit]";
    if ($conn->query($sql) === TRUE) {
    }
    // Close the connection
    $conn->close();
}
