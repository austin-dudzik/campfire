<?php
// Include the init file
require_once "../functions/init.php";
// Start the DB connection
// Get the campaign variables
$sql = "SELECT title, subtitle, rating, emailField, accent, position, type, buttonText, privacy FROM campaigns WHERE id='$_GET[campaign]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $widgetTitle = clean($row["title"]);
        $widgetSubtitle = clean($row["subtitle"]);
        $widgetRating = clean($row["rating"]);
        $widgetEmailField = clean($row["emailField"]);
        $widgetAccent = clean($row["accent"]);
        $widgetPosition = clean($row["position"]);
        $widgetType = clean($row["type"]);
        $widgetButtonText = clean($row["buttonText"]);
        $widgetPrivacy = clean($row["privacy"]);
        $widgetError = "false";
    }
} else {
    $widgetError = "true";
}
if (isset($_GET["type"]) == "widget") {
    // Set the content-type for the file
    header('Content-Type: application/javascript'); ?>
/**
  Campfire v1.3 - Website feedback platform
  Updated: March 28th 2022
*/

<?php if ($widgetError == "true") { ?>
  console.error("Campfire: The feedback widget (#<?= $_GET['campaign']; ?>) embedded on this page does not exist.");
<?php
    } else { ?>
  document.write("<link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,600,700' rel='stylesheet'><link href='<?= $url ?>/assets/libs/fontawesome-pro/css/all.min.css' rel='stylesheet'><script type='text/javascript' src='<?= $url ?>/assets/js/vendors/jquery-3.2.1.min.js'></script><link rel='stylesheet' media='all' href='<?= $url ?>/assets/css/siteFeedback.css'> <style> .feedbackFloat {background-color:<?= $widgetAccent ?>;} </style><div class='cf-widget'> <div class='lw-widget <?php if($widgetType == "") { if($widgetPosition == "1") {echo 'lw-widget_left'; } } if ($widgetType == "1") { echo 'lw-widget_sidebar '; if($widgetPosition == "1") {echo 'lw-widget_left'; } } if($widgetType == "2") {echo 'lw-widget_fullscreen'; } ?>' id='feedbackWidget'> <div class='lw-overlay' data-lw-close></div> <div class='lw-container lw-container_md'> <div class='lw-item' style='--theme-color: <?= $widgetAccent ?>'> <button class='lw-close' data-lw-close><i class='fal fa-times closeIcon'></i></button> <div class='lw-wrap lw-p-lg'><div id='widgetHeader'> <div class='lw-logo lw-logo_icon lw-mb-md iconBlock'> <div class='lw-preview'><i class='far fa-comment faIcon'></i></div> </div> <div class='lw-title lw-title_lg widgetTitle'><?= $widgetTitle ?></div> <div class='lw-content lw-mb-sm widgetSubtitle'><?= $widgetSubtitle ?></div></div><div id='response'><form id='feedbackForm'> <input type='text' name='campaignId' value='<?= $_GET['campaign']; ?>' hidden> <?php if ($widgetRating == '1') { ?> <div class='lw-title lw-title_sm lw-mb-sm rateTitle'>Rate your experience</div> <div class='lw-tags lw-mb-sm emojiContainer'> <div class='lw-tags-item lw-active rateItem' data-value='5' title='Amazing'><i class='fad fa-grin-hearts'></i></div> <div class='lw-tags-item rateItem'  data-value='4' title='Great'><i class='fad fa-grin'></i></div> <div class='lw-tags-item rateItem' data-value='3' title='OK'><i class='fad fa-meh'></i></div> <div class='lw-tags-item rateItem' data-value='2' title='Bad'><i class='fad fa-frown'></i></div> <div class='lw-tags-item rateItem' data-value='1' title='Terrible'><i class='fad fa-angry'></i></div> </div> <input type='text' name='rate' id='rateValue' value='5' hidden> <?php } ?> <div class='lw-mb-md'> <?php if ($widgetPrivacy !== "1") { ?><div class='lw-field lw-mb'> <div class='lw-icon'><i class='fas fa-envelope'></i></div><input class='lw-input' type='email' name='email' placeholder='Email address' <?php if ($widgetEmailField == "1") { echo 'required'; } ?>> </div><?php } ?> <div class='lw-field'><textarea class='lw-textarea' name='message' placeholder='Tell us what you think...' required></textarea></div> </div><input type='text' name='campaign' value='1' hidden> <button type='submit' id='feedbackSubmit' class='lw-btn lw-btn_wide'>Send feedback</button> </form></div> </div> </div> </div> </div> <div class='feedbackFloat' id='feedbackFloat' data-cf-launch='#feedbackWidget' style='<?= $widgetPosition == "1" ? 'left:40px' : 'right:40px' ?>'> <i class='fas fa-comment feedbackIcon'  data-cf-launch='#feedbackWidget'></i> <p data-cf-launch='#feedbackWidget'><?= $widgetButtonText ?></p> </div></div><script>var postUrl = '<?= $url ?>/functions/submit.php';</script><script type='text/javascript' src='<?= $url ?>/assets/js/siteFeedback.js'></script>");

<?php
    }
} else {
?>
<!doctype html>
<html lang="en">
   <head>
      <title><?= $widgetError == 'false' ? $widgetTitle : '404 Not Found' ?></title>
      <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600,700" rel="stylesheet">
      <link href="<?= $url ?>/assets/libs/fontawesome-pro/css/all.min.css" rel="stylesheet">
      <script type="text/javascript" src="<?= $url ?>/assets/js/vendors/jquery-3.2.1.min.js"></script>
      <link rel="stylesheet" media="all" href="<?= $url ?>/assets/css/siteFeedback.css">
   </head>
   <body class="cf-widget body">
      <div class="lw-widget feedbackPage lw-widget_fullscreen" data-lw-onload>
         <div class="lw-container lw-container_md">
            <div class="lw-item feedbackContain" style="--theme-color:<?= $widgetError == "false" ? $widgetAccent : '' ?>">
               <div class="lw-wrap lw-p-lg">
                 <?php if ($widgetError == "true") { ?>
                   <div class="lw-title lw-title_lg lw-center">Page Not Found</div>
                   <div class="lw-content lw-mb-sm lw-center">The feedback form you're trying to access doesn't exist.</div>
                 <?php } else { ?>
                   <div id="widgetHeader">
                  <div class="lw-logo lw-logo_icon lw-logo_center lw-mb-md iconBlock">
                     <div class="lw-preview"><i class="far fa-comment faIcon"></i></div>
                  </div>
                  <div class="lw-title lw-title_lg widgetTitle"><?= $widgetTitle ?></div>
                  <div class="lw-content lw-mb-sm widgetSubtitle"><?= $widgetSubtitle ?></div>
                </div>
                  <div id="response">
                  <form id="feedbackForm">
                     <input type="hidden" name="campaignId" value="<?= $_GET["campaign"] ?>">
                     <?php if ($widgetRating == "1") { ?>
                     <div class="lw-title lw-title_sm lw-mb-sm rateTitle">Rate your experience</div>
                     <div class="lw-tags lw-mb-sm emojiContainer">
                        <div class="lw-tags-item lw-active rateItem" data-value="5" title="Amazing"><i class="fad fa-grin-hearts"></i></div>
                        <div class="lw-tags-item rateItem" data-value="4" title="Great"><i class="fad fa-grin"></i></div>
                        <div class="lw-tags-item rateItem" data-value="3" title="OK"><i class="fad fa-meh"></i></div>
                        <div class="lw-tags-item rateItem" data-value="2" title="Bad"><i class="fad fa-frown"></i></div>
                        <div class="lw-tags-item rateItem" data-value="1" title="Terrible"><i class="fad fa-angry"></i></div>
                     </div>
                     <input type="text" name="rate" id="rateValue" value="5" hidden>
                     <?php } ?>
                     <div class="lw-mb-md">
                       <?php if ($widgetPrivacy !== "1") { ?>
                        <div class="lw-field lw-mb">
                           <div class="lw-icon"><i class="fas fa-envelope"></i></div>
                           <input class="lw-input" type="email" name="email" value="<?= $_GET["email"] ?? '' ?>" placeholder="Email address" <?= $widgetEmailField == "1" ? 'required' : '' ?>>
                        </div>
                        <?php } ?>
                        <div class="lw-field">
                            <textarea class="lw-textarea" name="message" placeholder="Tell us what you think..." required></textarea>
                        </div>
                     </div>
                     <input type="hidden" name="campaign" value="1">
                     <button type="submit" id="feedbackSubmit" name="submit" value="1" class="lw-btn lw-btn_wide">Send feedback</button>
                  </form>
                </div>
              <?php } ?>
               </div>
            </div>
         </div>
      </div>
    </body>
      <script src="<?= $url ?>/assets/js/siteFeedback.js"></script>
      <script>let postUrl = "<?= $url . '/functions/submit.php' ?>"</script>
</html>
<?php } ?>
