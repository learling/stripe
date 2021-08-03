<?php
require_once("config/apis.php");

session_start();

$_SESSION["csrf_token"] = uniqid("", true);
if (!isset($_SESSION["shopping_cart"]) || sizeof($_SESSION["shopping_cart"]) < 1) {
  header("Location: index.php");
}
$products = $_SESSION["shopping_cart"];
$sum = 0;
$ids = "";
foreach ($products as $product) {
  $ids .= $product["id"] . ", ";
  $sum += $product["price"] * 1;
}
$names = substr($ids, 0, -2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("inc/head.php") ?>
  <title>Fake payment</title>
</head>
<body>
  <?php include_once("inc/navbar.php") ?>
  <div class="container">
    <h1>Fake shopping cart</h1>
    <div class="card-columns my-4">
      <?php foreach ($products as $product) : ?>
        <div class="card text-white bg-dark">
          <div class="card-header h5 text-center"><?php echo $product["id"]; ?></div>
          <div class="card-body">
            <?php echo number_format($product["price"] * 1, 2, ".", ""); ?>
            <?php echo strtoupper(CURRENCY); ?>
            <hr>
            <small>
              <?php echo $product["description"]; ?>
            </small>
          </div>
          <div class="card-footer text-center">
            <form action="remove.php" method="post">
              <input hidden name="product_id" value="<?php echo $product["id"]; ?>" />
              <input hidden name="price" value="<?php echo $product["price"]; ?>" />
              <input hidden name="currency" value="<?php echo CURRENCY ?>" />
              <textarea hidden name="description"><?php echo $product["description"]; ?></textarea>
              <input title="Remove product from shopping cart" type="submit" class="btn btn-light btn-sm" value="Remove" />
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <input type="hidden" id="api-key" value=<?php echo STRIPE_PUBLISHABLE_TEST; ?> />
    <form action="charge.php" method="post" id="payment-form">
      <input hidden name="csrf" value="<?php echo $_SESSION["csrf_token"]; ?>" />
      <input hidden name="product_id" value="<?php echo $names; ?>" />
      <input hidden name="price" value="<?php echo $sum; ?>" />
      <input hidden name="currency" value="<?php echo CURRENCY; ?>" />
      <input hidden name="description" value="<?php echo $names; ?>" />
      <div class="card bg-dark p-4 mb-4">
        <div class="form-row">
            <input required type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email address">
            <div id="card-element" class="form-control">
            <!-- Stripe Element will be inserted here. -->
            </div>
            <input required type="checkbox" class="m-3">
            <label for="agree" class="m-3 text-light">
              <span>Agree to <a target="_blank" href="/datenschutz.php">Datenschutz</a></spans>
            </label>
            <div class="text-light" id="card-errors" role="alert"></div>
        </div>
        <div class="card-footer text-center">
          <button class="btn btn-lg mt-4">Pay <?php echo number_format($sum * 1, 2, ".", "") . " " . strtoupper(CURRENCY); ?> now</button>
        </div>
      </div>
    </form>
    <p>
      <a href="index.php" class="btn btn-light btn-sm mt-2">Go back</a>
    </p>
  </div>
  <?php include_once("inc/footer.php") ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="./js/charge.js"></script>
</body>
</html>