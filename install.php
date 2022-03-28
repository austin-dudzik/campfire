<?php
// Redirect if installed
//if (file_exists('functions/config.php')) {
//    header("Location: index");
//    exit;
//}
if (isset($_POST["submit"])) {
    $url = filter_var($_POST["url"], FILTER_SANITIZE_URL);
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    $url = rtrim($url, "/");
    $first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
    $last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $db_name = filter_var($_POST["db_name"], FILTER_SANITIZE_STRING);
    $db_user = filter_var($_POST["db_user"], FILTER_SANITIZE_STRING);
    $db_password = filter_var($_POST["db_password"], FILTER_SANITIZE_STRING);
    $db_host = filter_var($_POST["db_host"], FILTER_SANITIZE_STRING);
    $sql = "
   SET NAMES utf8;
   SET time_zone = '+00:00';
   SET foreign_key_checks = 0;
   SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

   SET NAMES utf8mb4;

   DROP TABLE IF EXISTS `campaigns`;
   CREATE TABLE `campaigns` (
     `id` int(11) NOT NULL,
     `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `subtitle` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `rating` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `emailField` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `accent` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `position` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `buttonText` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `tyTitle` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `tyMessage` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `privacy` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `created` text COLLATE utf8mb4_unicode_ci NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

   INSERT INTO `campaigns` (`id`, `name`, `title`, `subtitle`, `rating`, `emailField`, `accent`, `buttonText`, `tyTitle`, `tyMessage`, `privacy`, `created`) VALUES
   (1, 'First Campaign', 'How are we doing?', 'Leave us feedback so we know how we\'re doing.', '1', '', '#41FFBB', 'Leave feedback', 'Thank you!', 'Thanks for your feedback. We will continue to improve based on the suggestions you provided.', '', 'August 17, 2022');

   DROP TABLE IF EXISTS `responses`;
   CREATE TABLE `responses` (
     `id` int(11) NOT NULL,
     `campaignId` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
     `rate` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `ip` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `created` text COLLATE utf8mb4_unicode_ci NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

   INSERT INTO `responses` (`id`, `campaignId`, `email`, `message`, `rate`, `ip`, `created`) VALUES
   (1, '1', 'user@example.com', 'Just an example response', '5', '0.0.0.0.0', 'June 1, 2020, 12:00 am');

   DROP TABLE IF EXISTS `users`;
   CREATE TABLE `users` (
     `id` int(11) NOT NULL,
     `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
     `role` int(1) NOT NULL,
     `owner` int(1) NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

   INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `owner`) VALUES
   (1, '$first_name', '$last_name', '$email', '$password', 0, 1);

   ALTER TABLE `campaigns`
     ADD PRIMARY KEY (`id`);

   ALTER TABLE `responses`
     ADD PRIMARY KEY (`id`);

   ALTER TABLE `users`
     ADD PRIMARY KEY (`id`);

   ALTER TABLE `campaigns`
     MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

   ALTER TABLE `responses`
     MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

   ALTER TABLE `users`
     MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
   COMMIT;";
    $config = '<?php

      // Default time zone
      date_default_timezone_set("America/Chicago");

      $host = "' . $db_host . '"; // Host (typically "localhost")
      $username = "' . $db_user . '"; // Database Username
      $password = "' . $db_password . '"; // Database password
      $dbname = "' . $db_name . '"; // Database name
      $url = "' . $url . '"; // Installation URL

      ?>';
    if (!empty($db_name)) {
        (new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_password))->query($sql);
        file_put_contents("functions/config.php", $config);
        header("Location: $url");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="assets/images/logo.png" type="image/png">
      <title>Installation | Campfire</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700">
      <link href="assets/libs/fontawesome-pro/css/all.min.css" rel="stylesheet">
      <link href="assets/css/dashboard.css" rel="stylesheet" />
   </head>
   <body>
      <div class="page">
         <div class="page-main">
            <div class="header py-4">
               <div class="container">
                  <div class="d-flex">
                     <a class="header-brand" href="">
                     <img src="assets/images/logo.svg" class="header-brand-img mr-2" alt="Campfire logo">
                     <span class="hidden-sm-down">Campfire</span>
                     </a>
                     <div class="d-flex order-lg-2 ml-auto">
                        <div class="nav-item d-none d-md-flex">
                           <a href="https://campfire-docs.hexagonal.agency/installation" target="_blank" class="btn btn-sm pl-4 pr-4  pt-2 pb-2 bg-camp"><i class="fal fa-book mr-2"></i> Documentation</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="my-3 my-md-5">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-10 order-md-1">
                        <div class="row">
                           <div class="col-12">
                              <div class="card">
                                 <div class="card-body">
                                    <h4>Welcome to Campfire</h4>
                                    <p>Thank you for purchasing. This page will take you through the necessary steps to installing Campfire on your server.</p>
                                    <a href="https://campfire-docs.hexagonal.agency/installation" target="_blank" class="btn btn-sm mr-1 pl-4 pr-4 pt-2 pb-2 btn-dark"><i class="fal fa-envelope mr-2"></i> Contact us</a>
                                    <a href="https://campfire-docs.hexagonal.agency/installation" target="_blank" class="btn btn-sm pl-4 pr-4 pt-2 pb-2 btn-dark"><i class="fal fa-book mr-2"></i> Documentation</a>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header">
                                    <h3 class="card-title"><i class="fe fe-edit-2 mr-2"></i> Campaign Editor</h3>
                                    <div class="card-options">
                                       <a href="mailto:support@hexagonal.agency?subject=Campfire%20support" target="_blank" class="btn bg-camp text-white">Need help?</a>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <form method="post">
                                       <div class="row">
                                          <div class="col-lg-4 col-12">
                                             <h4 class="mb-5">
                                                Installation URL
                                             </h4>
                                             <p>This is the location where you'll be installing Campfire on your server. You can usually leave this set to what it is.</p>
                                          </div>
                                          <div class="col-lg-5 col-12">
                                             <div class="form-group">
                                                <label>Installation URL</label>
                                                <input type="url" class="form-control" name="url" value="
                                                <?= (isset($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) ?>" required>
                                             </div>
                                          </div>
                                       </div>
                                       <hr>
                                       <div class="row">
                                          <div class="col-lg-4 col-12">
                                             <h4 class="mb-5">
                                                Database Details
                                             </h4>
                                             <p>Make sure to create a database for Campfire to connect to. You'll put your databse details in this section.</p>
                                          </div>
                                          <div class="col-lg-5 col-12">
                                             <div class="form-group">
                                                <label>Database Host</label>
                                                <input type="text" class="form-control" name="db_host" value="localhost" required>
                                             </div>
                                             <div class="form-group">
                                                <label>Database Name</label>
                                                <input type="text" class="form-control" name="db_name" required>
                                             </div>
                                             <div class="form-group">
                                                <label>Database User</label>
                                                <input type="text" class="form-control" name="db_user" required>
                                             </div>
                                             <div class="form-group">
                                                <label>Database Password</label>
                                                <input type="password" class="form-control" name="db_password">
                                             </div>
                                          </div>
                                       </div>
                                       <hr>
                                       <div class="row">
                                          <div class="col-lg-4 col-12">
                                             <h4 class="mb-5">
                                                Account Details
                                             </h4>
                                             <p>These are the details for your account. Don't forget them, as you'll need these to log in to Campfire.</p>
                                          </div>
                                          <div class="col-lg-5 col-12">
                                             <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name" required>
                                             </div>
                                             <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name" required>
                                             </div>
                                             <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" class="form-control" name="email" required>
                                             </div>
                                             <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" required>
                                             </div>
                                          </div>
                                       </div>
                                 </div>
                                 <div class="card-footer">
                                 <div class="text-center">
                                 <button class="btn bg-camp w-50" type="submit" name="submit" value="1" onclick="$('#editCampaign').submit(); $(this).addClass('disabled').addClass('btn-loading');">Install Campfire <i class="fas fa-arrow-right ml-2"></i> </button>
                                 </div>
                                 </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <script src="assets/js/vendors/jquery-3.2.1.min.js"></script>
         <script src="assets/js/vendors/bootstrap.bundle.min.js"></script>
      </div>
   </body>
</html>
