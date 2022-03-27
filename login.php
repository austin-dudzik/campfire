<?php
// Include the init file
include ("functions/init.php");
// Redirect if logged in
if (logged_in()) {
    header("Location:index.php");
}
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Log in | Campfire</title>
<?php include 'includes/styles.php'; ?>
   </head>
   <body>
      <div class="page">
         <div class="page-single">
            <div class="container">
               <div class="row">
                  <div class="col col-login mx-auto">
                     <div class="text-center mb-6">
                        <a class="header-brand" href="<?php echo $url ?>">
                           <img src="<?php echo $url ?>/assets/images/logo.svg" class="header-brand-img mr-2" alt="Campfire logo">
                           <h1 class="d-inline">Campfire</h1>
                        </a>
                     </div>
                     <div class="card">
                        <div class="card-body p-6">
                           <div class="card-title text-center">Log in to Campfire</div>
                           <?php display_message(); ?>
                           <?php validate_user_login(); ?>
                           <form method="post">
                              <div class="form-group">
                                 <label class="form-label">Email address</label>
                                 <input type="email" class="form-control " id="email" name="email" value="" placeholder="Enter email" autofocus required>
                                 <div class="invalid-feedback"></div>
                              </div>
                              <div class="form-group mb-6">
                                 <label class="form-label">
                                 Password
                                 </label>
                                 <input type="password" name="password" class="form-control " id="exampleInputPassword1" placeholder="Password" required>
                                 <div class="invalid-feedback"></div>
                              </div>
                              <div class="form-footer">
                                 <button type="submit" name="login-submit" id="login-btn" class="btn bg-camp btn-block p-2">Sign in</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   <!-- Required scripts -->
   <script src="<?php echo $url ?>/assets/js/vendors/jquery-3.2.1.min.js"></script>
   <script src="<?php echo $url ?>/assets/js/vendors/bootstrap.bundle.min.js"></script>
   <script src="<?php echo $url ?>/assets/js/jscolor.min.js"></script>
   <script src="<?php echo $url ?>/assets/js/clipboard.min.js"></script>
   <script src="<?php echo $url ?>/assets/js/dashboard.js"></script>
</html>
