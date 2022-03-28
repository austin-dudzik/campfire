<?php
// Set the page name
$page = "editor";
// Include the init file
include "../functions/init.php";
// Redirect if not logged in
if (!logged_in()) {
    header("Location:../../login");
}
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?= $url ?>/assets/images/logo.png" type="image/png">
      <title>Editor | Campfire</title>
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
                        <span><?= clean($widgetName) ?></span>
                     </h2>
                  </div>
                  <div class="row">
                     <?php include "../includes/sidebar.php"; ?>
                     <div class="col-lg-10 order-md-1">
                        <div class="row">
                           <div class="col-12">
                              <div class="card">
                                 <div class="card-body mt-3">
                                       <div class="row">
                                          <div class="col-lg-7 col-12">
                                             <h4 class="mb-3">
                                                Campaign Editor
                                             </h4>
                                             <p>Campfire makes it quick and easy to build and modify your campaigns, using the live campaign customizer.</p>
                                          </div>
                                          <div class="col-lg-5 col-12">
                                            <div class="text-center">
                                            <a href="<?= $url . '/campaign/' . $_GET["campaign"] . '/editor/view' ?>" class="btn bg-camp w-50 mt-5" onclick="$('#editCampaign').submit(); $(this).addClass('disabled').addClass('btn-loading');">Launch editor <i class="fe fe-arrow-right ml-2"></i></a>
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
            </div>
         </div>
         <?php include "../includes/footer.php" ?>
      </div>
   </body>
</html>
