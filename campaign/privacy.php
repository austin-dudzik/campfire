<?php
// Set the page name
$page = "privacy";
// Include the init file
include "../functions/init.php";
// Redirect if not logged in
if (!logged_in()) {
    header("Location:../../login");
}
// Include the functions file
include "../functions/pages/privacy.php";
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Privacy | Campfire</title>
<?php include '../includes/styles.php'; ?>
   </head>
   <body>
      <div class="page">
         <div class="page-main">
            <?php include "../includes/header.php" ?>
            <div class="my-3 my-md-5">
               <div class="container">
                  <div class="page-header">
                     <div class="avatar bg-camp d-block mr-2" id="loadSwitchDiv">
                        <i class="fe fe-layout" id="loadSwitch"></i>
                     </div>
                     <h2 class="page-title">
                        <span><?php echo htmlentities($widgetName, ENT_QUOTES, 'UTF-8'); ?></span>
                     </h2>
                  </div>
                  <div class="row">
                     <?php include "../includes/sidebar.php"; ?>
                     <div class="col-lg-10 order-md-1">
                        <div class="row">
                           <div class="col-12">
                              <div class="card">
                                 <div class="card-header">
                                    <h3 class="card-title text-dark"><i class="fe fe-eye mr-2"></i> Privacy</h3>
                                 </div>
                                 <div class="card-body">
                                    <p>Campfire gives you the ability to disable the collection of user-indentifiable data for each campaign. This feature allows all collected feedback to remain anonymous and non-trackable.</p>
                                    <strong>When enabled...</strong>
                                    <ul>
                                       <li>Email collection is turned off</li>
                                       <li>IP addresses are not tracked</li>
                                    </ul>
                                    <strong>Important:</strong> Any feedback that was collected when privacy mode was enabled will still remain anonymous, even if turned off.
                                    <div class="mt-5 mb-3">
                                       <form method="post">
                                          <input type="hidden" name="submit" value="1">
                                          <button type="submit" name="privacy" value="<?php if (!$widgetPrivacy) {
    echo "1";
} ?>" class="btn btn-indigo w-25" onclick="$(this).addClass('disabled').addClass('btn-loading');">
                                          <?php if (!$widgetPrivacy) {
    echo '<i class="fe fe-toggle-left mr-2"></i> Enable privacy';
} else {
    echo '<i class="fe fe-toggle-right mr-2"></i> Disable privacy';
} ?>
                                          </button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php include "../includes/footer.php" ?>
      </div>
   </body>
</html>
