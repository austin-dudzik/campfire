<?php
// Redirect if not installed
if (!file_exists('functions/config.php')) {
    header("Location: install");
    exit;
}
// Include the init file
include ("functions/init.php");
// Redirect if not logged in
if (!logged_in()) {
    header("Location:login");
}
// Include the functions file
include "functions/pages/home.php";
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Campaigns | Campfire</title>
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
                        My Campaigns
                     </h1>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 col-md-3 col-lg-2 mb-5">
                        <div class="card home h-100 bg-camp text-white" data-toggle="modal" data-target="#newListModal" id="newListModalBtn" data-backdrop="static" data-keyboard="false">
                           <div class="card-body text-center py-6 d-flex justify-content-center align-items-center">
                              <h4>
                                 <i class="display-4 d-block font-weight-bold mb-4">+</i>
                                  New Campaign
                              </h4>
                           </div>
                        </div>
                     </div>
                     <?php
                     $stmt = $conn->prepare("SELECT ca.id, ca.name, (SELECT COUNT(id) FROM responses re WHERE re.campaignId = ca.id) re_count FROM campaigns ca ORDER BY ca.id DESC");
                     $stmt->execute();
                     $result = $stmt->get_result();

                     if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {  ?>
                     <div class="col-sm-6 col-md-3 col-lg-2 mb-5">
                  <a href="<?= $url . '/campaign/' . $row["id"] . '/editor' ?>">
                        <div class="card home h-100 mb-0">
                           <div class="card-body text-center py-7">
                              <h4 class="text-truncate text-dark">
                                 <?= clean($row["name"]); ?>
                              </h4>
                           </div>
                           <div class="card-footer card-footerHome">
                              <a href="<?= $url . '/campaign/' . $row["id"] . '/responses' ?>" class="tag text-dark">
                               <?= $row["re_count"] . " " . ($row["re_count"] == "1" ? "response" : "responses") ?>
                              </a>
                              <div class="item-action dropdown campaignDropdown">
                                 <a href="javascript:void(0)" data-toggle="dropdown" class="icon">
                                     <i class="fe fe-more-horizontal"></i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?= $url . '/campaign/' . $row["id"] . '/integrations' ?>" class="dropdown-item"><i class="dropdown-icon fe fe-code"></i> Integrations</a>
                                    <a href="<?= $url . '/campaign/' . $row["id"] . '/privacy' ?>" class="dropdown-item"><i class="dropdown-icon fe fe-eye"></i> Privacy</a>
                                    <a href="<?= $url . '/campaign/' . $row["id"] . '/data' ?>" class="dropdown-item"><i class="dropdown-icon fe fe-database"></i> Data Manager</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?= $url . '/campaign/' . $row["id"] . '/delete' ?>" class="dropdown-item text-red"><i class="dropdown-icon fe fe-trash text-red"></i> Delete campaign</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                         </a>
                     </div>
                     <?php
    }
} else { ?>
                     <div class="ml-7 mt-6">
                        <h1 class="font-weight-normal">
                           📩 Create your first campaign
                        </h1>
                        <p class="lead font-weight-normal">
                           Start tracking user feedback by creating a new campaign.<br>
                           Once you've done that, your campaigns will live here.
                        </p>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="modal fade" id="newListModal">
                  <div class="modal-dialog modal-dialog-centered modal-s">
                     <div class="modal-content px-3">
                        <div class="modal-header">
                           <h5 class="modal-title">New Campaign</h5>
                           <button type="button" class="close" data-dismiss="modal"></button>
                        </div>
                        <form method="post">
                           <div class="modal-body">
                              <div class="form-group">
                                 <div class="input">
                                    <input type="text" class="form-control mb-2" name="name" placeholder="Campaign name" aria-label="Campaign name" required>
                                    <small>This is only used internally when you need to identify the campaign.</small>
                                 </div>
                              </div>
                              <button type="submit" name="submit" class="btn bg-camp w-25 btn-block new-list-modal-btn mb-3"><i class="fe fe-check"></i> Create</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php include "includes/footer.php"; ?>
   </body>
</html>
