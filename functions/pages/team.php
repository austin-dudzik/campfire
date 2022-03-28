<?php
// If profile form is submitted...
if (isset($_POST["create"])) {

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $_POST["email"]);
    $stmt->execute();

    if ($stmt->get_result()->num_rows == 0) {

        // Close the previous connection
        $stmt->close();

        // Hash the password
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        // Insert the user into the database
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssi', $_POST["first_name"], $_POST["last_name"], $_POST["email"], $password, $_POST["role"]);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $success = "Successfully created user!";
        } else {
            $error = "Sorry, an error has occurred: " . " " . $conn->error;
        }

    } else {
        $error = "Email already exists!";
    }

}

if (isset($_POST['editUser'])) {

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ? LIMIT 1");
    $stmt->bind_param('si', $_POST["email"], $_POST["user_id"]);
    $stmt->execute();

    if ($stmt->get_result()->num_rows == 0) {

        // Close the previous connection
        $stmt->close();

        // Hash password or return empty string if password empty
        $password = !empty($_POST["password"]) ? password_hash(escape($_POST["password"]), PASSWORD_DEFAULT) : '';

        // Update the user
        $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, password = IF(? = '', password, ?), role = ? WHERE id= ? LIMIT 1");
        $stmt->bind_param('sssssii', $_POST['first_name'], $_POST['last_name'], $_POST['email'], $password, $password, $_POST['role'], $_POST['user_id']);
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

if (isset($_POST['deleteUser'])) {

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? LIMIT 1");
    $stmt->bind_param('s', $_POST["user_id"]);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $success = "Successfully deleted user!";
    } else {
        $error = "Sorry, an error has occurred: " . " " . $conn->error;
    }

}