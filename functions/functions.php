<?php
/**************** Helper functions ********************/
function clean($string): string
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function escape($string): string
{
    global $conn;
    return $conn->real_escape_string($string);
}

function redirect($location)
{
    header("Location: $location");
}

function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function validation_errors($error_message): string
{
    return '<div class="alert alert-danger bg-red text-white" role="alert">
                <strong>Error:</strong>' . $error_message . '
            </div>';
}


/**************** Validate user login functions ********************/
function validate_user_login()
{
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        if (empty($email)) {
            $errors[] = "Email field cannot be empty";
        }
        if (empty($password)) {
            $errors[] = "Password field cannot be empty";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            if (login_user($email, $password)) {
                redirect("index.php");
            } else {
                echo validation_errors("Your credentials are incorrect");
            }
        }
    }
} // function


/**************** User login functions ********************/
function login_user($email, $password)
{
    $sql = "SELECT password, id FROM users WHERE email = '" . escape($email) . "'";
    $result = query($sql);
    if (row_count($result) == 1) {
        $row = fetch_array($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


/**************** Check if user is logged in ********************/
function logged_in() {
    return isset($_SESSION['email']);
}

function row_count($result) {
    return mysqli_num_rows($result);
}

function confirm($result) {
    global $conn;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    confirm($result);
    return $result;
}

function fetch_array($result) {
    return mysqli_fetch_array($result);
}