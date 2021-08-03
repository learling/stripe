<?php
require_once("config/apis.php");

session_start();

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

if (!empty($_POST["product_id"])) {
  if (!isset($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = array();
  }
  $product = array(
    "id" => $_POST["product_id"],
    "price" => $_POST["price"],
    "description" => $_POST["description"]
  );
  if (!in_array($product, $_SESSION["shopping_cart"])) {
    array_push($_SESSION["shopping_cart"], $product);
  }
}

header("Location: index.php");