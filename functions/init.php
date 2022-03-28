<?php
session_start();

// Require files
require_once "config.php";
require_once "functions.php";

// Global connection
$conn = new mysqli($host, $username, $password, $dbname);

if (isset($_SESSION['email'])) {
    $sql = "SELECT id, first_name, last_name, email, role FROM users WHERE email='$_SESSION[email]'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row['id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $role = $row['role'];
        }
    }
    if (isset($page)) {
        // Get the campaign variables
        $sql = "SELECT * FROM campaigns WHERE id='$_GET[campaign]'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $widgetName = $row["name"];
                $widgetTitle = $row["title"];
                $widgetSubtitle = $row["subtitle"];
                $widgetRating = $row["rating"];
                $widgetEmailField = $row["emailField"];
                $widgetAccent = $row["accent"];
                $widgetPosition = $row["position"];
                $widgetType = $row["type"];
                $widgetButtonText = $row["buttonText"];
                $widgetTyTitle = $row["tyTitle"];
                $widgetTyMessage = $row["tyMessage"];
                $widgetTyMessage = $row["tyMessage"];
                $widgetPrivacy = $row["privacy"];
            }
        } else {
            header("Location:$url");
        }
        // Count number of responses for campaign
        $sql1 = "SELECT COUNT(*) FROM responses WHERE campaignId='$_GET[campaign]'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $responses = $row1['COUNT(*)'];
            }
        }
    }
}
