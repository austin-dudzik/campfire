<?php
// Set the page name
$page = "delete";
// Include the init file
include "../functions/init.php";
// Redirect if not logged in
if (!logged_in()) {
    redirect("../../login");
}
// Include the functions file
include "../functions/pages/delete.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
    <title>Delete campaign | Campfire</title>
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
                                        <h3 class="card-title text-dark"><i
                                                    class="fe fe-trash mr-2"></i> Delete campaign
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <p>Are you sure you want to delete this campaign? All data,
                                            including feedback responses, will be permanently
                                            deleted.</p>
                                        <p>If you'd like, you can export your responses as a
                                            <strong>.CSV</strong> file before you delete this
                                            campaign.</p>
                                        <div class="mt-5">
                                            <form method="post" class="mb-5">
                                                <input type="hidden" name="deleteSubmit" value="1">
                                                <button type="submit"
                                                        class="btn btn-danger w-25 mr-1"
                                                        name="privacy" value="1"
                                                        onclick="$(this).addClass('disabled').addClass('btn-loading');">
                                                    <i class="fe fe-trash mr-2"></i> Delete campaign
                                                </button>
                                                <a href="<?php echo $url ?>/campaign/<?php echo $_GET["campaign"]; ?>/export"
                                                   class="btn btn-gray pl-4 pr-4"
                                                   onclick="$(this).addClass('disabled').addClass('btn-loading');">
                                                    <i class="fe fe-download mr-2"></i> Export
                                                </a>
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
