<?php
require_once("config/contact.php");

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("inc/head.php") ?>
  <title>Impressum</title>
</head>
<body>
  <?php include_once("inc/navbar.php") ?>
  <div class="container">
    <div class="jumbotron mt-4">
      <h4>Impressum</h4>
      <hr>
      <address><?php echo ADDRESS; ?></address>
    </div>
    <p><a href="index.php" class="btn btn-light btn-sm mt-2">Go back</a></p>
  </div>
  <?php include_once("inc/footer.php") ?>
</body>
</html>