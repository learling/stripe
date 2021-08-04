<?php
  session_start();

  if (!empty($_GET["tid"] && !empty($_GET["p"]))) {
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);
  } else {
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("inc/head.php") ?>
  <title>Thank you</title>
</head>
<body>
  <?php include_once("inc/navbar.php") ?>
  <div class="container">
    <div class="jumbotron mt-4">
      <h2>Thank you for purchasing fake</h2>
      <h4><?php echo urldecode($GET["p"]); ?></h4>
      <hr>
      <p>Your transaction ID is <?php echo $GET["tid"]; ?></p>
    </div>
    <p><a href="index.php" class="btn btn-light btn-sm mt-2">Go back</a></p>
  </div>
</body>
</html>