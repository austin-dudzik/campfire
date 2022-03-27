<?php
// Set the page name
$page = "data";
// Include the config file
include "../functions/config.php";
// Include the functions file
include "../functions/pages/data.php";
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
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Data Manager | Campfire</title>
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
                                    <h3 class="card-title text-dark"><i class="fe fe-database mr-2"></i> Data Manager</h3>
                                 </div>
                                 <div class="card-body">
                                   <?php if (isset($_POST["uploadImport"])) { ?>
                                   <div id="alertSlideSlow" class="alert bg-success text-white"><i class="far fa-check mr-3"></i> Success, feedback responses were imported successfully.</div>
                                   <?php } ?>
                                    <p>In order for you to back up and manage your data, Campfire provides the ability to export your feedback responses as a <strong>.CSV</strong> file. You also have the ability to import data from a previous export.</p>
                                    <strong>Notice:</strong> There are currently <?php echo $responses ?> rows of feedback data.
                                    <div class="mt-5 mb-3">
                                          <button type="button" data-toggle="modal" data-target="#importModal" class="btn btn-gray w-25 mx-1">
                                          <i class="fe fe-upload mr-2"></i> Import data
                                          </button>
                                       <form method="post" class="mb-5 d-inline">
                                          <input type="hidden" name="submit" value="1">
                                          <button type="submit" class="btn bg-camp w-25 mx-1">
                                          <i class="fe fe-download mr-2"></i> Download data
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
  <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please select a Campfire CSV file to import feedback responses.</p>
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
              <div class="custom-file">
                  <input type="file" class="custom-file-input" name="csv_data" accept=".csv" required>
                  <label class="custom-file-label">Choose file</label>
              </div>
          </div>
      <div class="text-center">
        <button type="submit" name="uploadImport" class="btn btn-gray w-75 mt-3 mb-3" value="1"><i class="fe fe-upload mr-2"></i> Upload CSV</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>
      <?php include "../includes/footer.php" ?>
      </div>
   </body>
</html>
