<nav class="navbar bg-dark justify-content-between mb-4">
  <a href="/" class="text-light brand">
    <h5>Testing Stripe</h5>
    <small>Nothing to buy here!</small>
  </a>
  <?php if (isset($_SESSION["shopping_cart"])
   && sizeof($_SESSION["shopping_cart"]) > 0
   && $_SERVER["REQUEST_URI"] !== "/payment.php") : ?>
    <a title="<?php var_export($_SESSION["shopping_cart"]); ?>" href="payment.php" class="btn btn-light btn-sm">
      <b>[<?php echo sizeof($_SESSION["shopping_cart"]); ?>]</b>
      Go to cart
    </a>
  <?php endif ?>
</nav>