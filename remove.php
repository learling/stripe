<?php
require_once("config/apis.php");

session_start();

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

if (!empty($_POST["product_id"])) {
  if (isset($_SESSION["shopping_cart"])) {
    $products = $_SESSION["shopping_cart"];
    for ($i = 0; $i < sizeof($products); $i++) {
      if ($products[$i]["id"] == $_POST["product_id"]) {
        unset($products[$i]);
        $_SESSION["shopping_cart"] = array_values($products);
      }
    }
  }
}

header("Location: payment.php");