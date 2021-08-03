<?php
require_once("config/db.php");
require_once("config/apis.php");
require_once("lib/Database.php");
require_once("models/Products.php");

session_start();

$db_products = new Products();
$products = $db_products->listAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once("inc/head.php") ?>
  <title>Fake products</title>
</head>
<body>
  <?php include_once("inc/navbar.php") ?>
  <div class="container">
    <h1 class="ml-1 text-white text-shadow"><?php echo sizeof($products); ?> fake products</h1>
    <div class="card-columns mt-2">
      <?php foreach ($products as $product) : ?>
        <div class="card text-white bg-dark m-2">
          <div class="card-header h5 text-center"><?php echo $product->id; ?></div>
          <div class="card-body">
            <?php echo number_format($product->price * 1, 2, ".", ""); ?>
            <?php echo strtoupper(CURRENCY); ?>
            <hr>
            <small>
              <?php echo $product->description; ?>
            </small>
          </div>
          <div class="card-footer text-center">
            <form action="add.php" method="post">
              <input hidden name="product_id" value="<?php echo $product->id; ?>" />
              <input hidden name="price" value="<?php echo $product->price; ?>" />
              <input hidden name="currency" value="<?php echo CURRENCY ?>" />
              <textarea hidden name="description"><?php echo $product->description; ?></textarea>
              <input type="submit" class="btn btn-light btn-sm" value="Add to cart" />
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php include_once("inc/footer.php") ?>
</body>
</html>