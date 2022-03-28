<?php
// Include the init file
include "functions/init.php";
// Redirect if not logged in
if (!logged_in()) {
    header("Location:login");
}

// Include the functions file
include "functions/pages/team.php";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
    <title>Team | Campfire</title>
    <?php include 'includes/styles.php'; ?>
</head>
<body>
<div class="page">
    <div class="page-main">
        <?php include "includes/header.php" ?>
        <div class="my-3 my-md-5">
            <div class="container">
                <div class="page-header">
                    <h1 class="page-title">
                        Team Members
                    </h1>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Member</h4>
                            </div>
                            <div class="card-body pt-1">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text"
                                                       class="form-control<?php if (empty($_POST['first_name']) && $_POST) {
                                                           echo ' required"';
                                                       } ?>" name="first_name" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text"
                                                       class="form-control<?php if (empty($_POST['last_name']) && $_POST) {
                                                           echo ' required"';
                                                       } ?>" name="last_name" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email"
                                                       class="form-control<?php if (empty($_POST['email']) && $_POST) {
                                                           echo ' required"';
                                                       } ?>" name="email" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password"
                                                       class="form-control<?php if (empty($_POST['password']) && $_POST) {
                                                           echo ' required"';
                                                       } ?>" name="password" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="form-control mb-2" name="role"
                                                        required>
                                                    <option value="1">Administrator</option>
                                                    <option value="2">Editor</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn bg-camp w-100" name="create"
                                            value="1"
                                            onclick="$(this).addClass('disabled').addClass('btn-loading');">
                                        Create user
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        } elseif (isset($success)) {
                            echo '<div class="alert alert-success">' . $success . '</div>';
                        }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Current Members</h4>
                            </div>
                            <div class="card-body pt-1">
                                <div class="row">

<?php
$sql = "SELECT id, first_name, last_name, CONCAT(first_name, ' ', last_name) name, email, role, owner FROM users";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) { ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <img class="avatar avatar-lg text-white"
                     src="<?= 'https://www.gravatar.com/avatar/' . md5($row["email"]) . '?d=mp' ?>">
                <p class="mt-3 m-0">
                    <span class="font-weight-bold mb-0"><?= $row["name"] ?></span>
                    <?php if ($row['id'] == $user_id) {
                        echo '(You)';
                    } ?>
                </p>
                <p class="mb-3"><?= ($row["role"] == 0) ? "Administrator" : "Editor"; ?></p>

                <a href="#"  class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editUserModal-<?= $row["id"] ?>">
                    <i class="fe fe-edit mr-1"></i>
                    Edit
                </a>
                <?php if ($row['owner'] != 1 || $row['id'] != $user_id) { ?>
                    <a href="#" class="btn btn-danger btn-sm"><i
                                class="fe fe-trash mr-1"></i>
                        Delete</a>
                <?php } ?>

                                                </div>
                                            </div>
                                        </div>


    <div class="modal fade" id="editUserModal-<?= $row["id"] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit user</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="editFirstName">First Name</label>
                                    <input type="text" class="form-control"
                                           name="first_name" id="editFirstName" value="<?= $row['first_name'] ?>"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="editLastName">Last Name</label>
                                    <input type="text" class="form-control"
                                           name="last_name" id="editLastName" value="<?= $row['last_name'] ?>"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="editEmail">Email address</label>
                                    <input type="email" class="form-control"
                                           name="email" id="editEmail" value="<?= $row['email'] ?>"
                                           required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="editPassword">Password</label>
                                    <input type="password" class="form-control"
                                           name="password" id="editPassword">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="editRole">Role</label>
                                    <select class="form-control mb-2" name="role" id="editRole" required>
                                        <option value="1" <?= $row['role'] == 0 ? 'selected' : '' ?>>Administrator</option>
                                        <option value="2" <?= $row['role'] == 1 ? 'selected' : '' ?>>Editor</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn bg-camp w-100" name="editUser"
                                value="1"
                                onclick="$(this).addClass('disabled').addClass('btn-loading');">
                            Save changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
</div>
</body>
</html>
