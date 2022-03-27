<?php
// Include the init file
include "functions/init.php";
// Redirect if not logged in
if (!logged_in()) {
    redirect("login");
}
// Require the functions file
require_once "functions/pages/profile.php";
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Profile | Campfire</title>
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
                        Your Profile
                     </h1>
                  </div>
                  <div class="row">
                     <div class="col-lg-4">
                        <div class="card card-profile">
                           <div class="card-body text-center">
                              <img class="avatar avatar-lg text-white" src="https://www.gravatar.com/avatar/<?php echo md5($email); ?>?d=<?php echo $url ?>/assets/images/avatar.png" onerror="this.src='<?php echo $url ?>/assets/images/avatar.png'">
                              <h3 class="mb-3 mt-4"><?= clean($first_name . ' ' . $last_name) ?></h3>
                              <p class="mb-4"><?= clean($email) ?></p>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-body">
                              <h5><i class="fas fa-fire-alt mr-2"></i> Thank you for purchasing!</h5>
                              <p>If you're satisfied with Campfire, we'd appreciate if you left a review on our CodeCanyon page. Thanks!</p>
                              <a href="https://codecanyon.net/user/_Hexagonal" target="_blank" class="btn btn-success btn-sm btn-block pt-2 pb-2">Envato profile <i class="fe fe-arrow-right ml-2"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-8">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Account Settings</h4>
                           </div>
                           <div class="card-body">
                              <form method="post">
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" class="form-control" name="first" value="<?= clean($first_name) ?>" required>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control" name="last" value="<?= clean($last_name) ?>" required>
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label>Email address</label>
                                          <input type="text" class="form-control mb-2" name="email" value="<?= clean($email) ?>" required>
                                          <small>Once you make account changes, you will be required to log back in.</small>
                                       </div>
                                    </div>
                                 </div>
                                 <button type="submit" class="btn bg-camp w-100" name="save" value="1" onclick="$('#editCampaign').submit(); $(this).addClass('disabled').addClass('btn-loading')">Save changes</button>
                              </form>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">Change password</h3>
                           </div>
                           <div class="card-body">
                              <form method="post">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label>New password</label>
                                          <input type="password" class="form-control mb-2" name="newPassword" required>
                                          <small>Once you submit, you will need to re-login with your new password.</small>
                                       </div>
                                    </div>
                                 </div>
                                 <button type="submit" class="btn bg-camp w-25" name="changePassword" value="1" onclick="$('#editCampaign').submit(); $(this).addClass('disabled').addClass('btn-loading');">Change password</button>
                              </form>
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
