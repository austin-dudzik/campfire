<?php
// If profile form is submitted...
if (isset($_POST["create"])) {

    // Hash the password
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssi', $_POST["first_name"], $_POST["last_name"], $_POST["email"], $password, $_POST["role"]);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $alert = "Successfully created user!";
    } else {
        echo "Sorry, an error has occurred: " . " " . $conn->error;
    }

}

if (isset($_POST['editUser'])) {

    // Set variables for sent values
    $userId = escape($_POST["user_id"]);
    $firstName = escape($_POST["first_name"]);
    $lastName = escape($_POST["last_name"]);
    $emailAddress = escape($_POST["email"]);
    $password = $_POST["password"];
    if (!empty($_POST["password"])) {
        $password_orig = escape($_POST["password"]);
        $password = password_hash($password_orig, PASSWORD_BCRYPT);
    }
    $role = escape($_POST["role"]);

    $sql = "SELECT `id` FROM `users` WHERE `email` = '$emailAddress' AND `id` = '$userId' LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_row();

    if ($result->num_rows > 0) {

        $sql = "UPDATE `users` SET  `first_name` = '$firstName', `last_name` = '$lastName', `email` = '$emailAddress', `password` = IF('" . $password . "' = '', `password`, '" . $password . "'), `role`= $role WHERE id='$_POST[user_id]' LIMIT 1";

        if ($conn->query($sql) === true) {
            $success = "Successfully updated user!";
        }
        else {
            echo "Sorry, an error occurred: ". " " . $conn->error;
        }

    }
    else {

        $sql = "SELECT id FROM users WHERE email = '$emailAddress' AND id != $userId LIMIT 1";
        $result = $conn->query($sql);
        $row = $result->fetch_row();

        if ($result->num_rows > 0) {
            $error = "Sorry, that email address is already in use.";
        }

        else {

            $sql = "UPDATE `users` SET `first_name` = '$firstName', `last_name` = '$lastName', `email` = '$emailAddress', `password` = IF('" . $password . "' = '', `password`, '" . $password . "'), `role`= $role WHERE id='$_POST[user_id]' LIMIT 1";

            if ($conn->query($sql) === true) {
                $success = "Successfully updated user!";
            }
            else {
                echo "Sorry, an error occurred: " . " " . $conn->error;
            }

        }
    }

}