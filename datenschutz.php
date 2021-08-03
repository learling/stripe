<?php
require_once("config/contact.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("inc/head.php") ?>
  <title>Datenschutz</title>
</head>
<body>
  <div class="container">
    <div class="jumbotron mt-4">
      <h4>Datenschutz</h4>
      <p>This site is just for testing purposes. We save the data you submit but no real credit card will be charged.</p>
      <p>Explore the open source
        <a target="_blank" href="https://github.com/learling/stripe">here</a>
      </p>
      <hr>
      <address><?php echo ADDRESS; ?></address>
    </div>
    <p><a href="index.php" class="btn btn-light btn-sm mt-2">Go back</a></p>
  </div>
  <?php include_once("inc/footer.php") ?>
</body>
</html>