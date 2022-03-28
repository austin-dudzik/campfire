<?php
// Set the page name
$page = "integrations";
// Require the init file
require_once "../functions/init.php";
// Redirect if not logged in
if (!logged_in()) {
    redirect("../../login");
}
// Require the functions file
require_once "../functions/pages/privacy.php";
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?= $url ?>/assets/images/logo.png" type="image/png">
      <title>Integrations | Campfire</title>
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
                                 <div class="card-header">
                                    <h3 class="card-title text-dark"><i class="fe fe-code mr-2"></i> Widget Embed</h3>
                                    <div class="card-options">
                                    </div>
                                 </div>
                                 <div class="card-body pt-1">
                                    <p>Copy the following code and paste it right before the <code>&lt;/body&gt;</code> tag on every page you'd like the widget to display.</p>
                                    <label class="form-label">Copy your code</label>
                                    <div class="textarea-container">
                                       <textarea id="embed" class="form-control bg-light" rows="3" style="resize: none" readonly>
&lt;!-- Start Campfire Widget --&gt;
&lt;script type="text/javascript" src="<?= $url . '/feedback/' . $_GET["campaign"] ?>/widget">&lt;/script&gt;
&lt;!-- End Campfire --&gt;</textarea>
                                    </div>
                                    <div class="mt-4 d-flex justify-content-center">
                                       <button type="submit" class="btn bg-camp copy-to-clipboard w-50" id="copy-to-clipboard" data-clipboard-action="copy" data-clipboard-target="#embed">
                                       <i class="fe fe-copy copy-to-clipboard mr-2"></i> Copy Code
                                       </button>
                                    </div>
                                    <a href="mailto:?subject=Campfire%20widget%20installation&body=Hi%2C%0A%0ACan%20you%20please%20help%20me%20install%20the%20Campfire%20feedback%20widget%20on%20our%20site.%0AIt%20will%20help%20us%20capture%20customer%20feedback%20on%20our%20website.%0AAdd%20the%20following%20bit%20of%20Javascript%20right%20before%20the%20closing%20%3C%2Fhead%3E%20of%20each%20page.%0A%0A%3C!--%20Start%20Campfire%20Widget%20--%3E%0A%3Cscript%20type%3D%22text%2Fjavascript%22%20src%3D%22<?= rawurlencode("$url/feedback/$_GET[campaign]/widget") ?>%22%3E%3C%2Fscript%3E%0A%3C!--%20End%20Campfire%20--%3E" target="_blank" class="text-muted d-block text-center mt-3">Send this to my developer</a>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <h3 class="card-title text-dark"><i class="fe fe-file-text mr-2"></i> Standalone page</h3>
                                    <div class="card-options">
                                    </div>
                                 </div>
                                 <div class="card-body py-1">
                                    <p>Instead of embedding Campfire on your website, you can supply your users with a standalone page where they can submit feedback.</p>
                                    <div class="textarea-container mb-5">
                                       <input id="pageLink" class="form-control mb-3 bg-light" value="<?= $url . '/feedback/' . $_GET["campaign"] ?>" readonly>
                                       <button type="submit" class="btn bg-camp mr-1 copy-page-clipboard" id="copy-page-clipboard" data-clipboard-action="copy" data-clipboard-target="#pageLink">
                                       <i class="fe fe-copy mr-2"></i> Copy URL
                                       </button>
                                       <a href="<?= $url . '/feedback/' .  $_GET["campaign"] ?>" target="_blank" class="btn btn-gray">
                                       <i class="fe fe-external-link mr-2"></i> Preview
                                       </a>
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
