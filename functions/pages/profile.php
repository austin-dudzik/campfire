<?php
// If profile form is submitted...
if (isset($_POST["save"])) {

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ? LIMIT 1");
    $stmt->bind_param('si', $_POST["email"], $user_id);
    $stmt->execute();

    if ($stmt->get_result()->num_rows == 0) {

        // Close the previous connection
        $stmt->close();
        // Update the user
        $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ? LIMIT 1");
        $stmt->bind_param('sssi', $_POST['first'], $_POST['last'], $_POST['email'], $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $success = "Successfully updated user!";
        } else {
            $error = "Sorry, an error has occurred: " . " " . $conn->error;
        }

    } else {
        $error = "Email already exists!";
    }

}
// If password form is submitted...
if (isset($_POST["changePassword"])) {

    // Update the password
    $password = escape(password_hash($_POST["newPassword"], PASSWORD_BCRYPT));
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ? LIMIT 1");
    $stmt->bind_param('si', $password, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        redirect("logout");
    } else {
        $error = "Sorry, an error has occurred: " . " " . $conn->error;
    }

}
