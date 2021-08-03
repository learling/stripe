<?php
require_once("config/apis.php");
require_once("config/db.php");
require_once("lib/Database.php");
require_once("models/Customer.php");
require_once("models/Transaction.php");

session_start();

unset($_SESSION["shopping_cart"]);

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

if ($_POST["csrf"] !== $_SESSION["csrf_token"]) {
  die("Invalid token");
}

if (empty($_POST["email"]
 || empty($_POST["stripeToken"])
 || empty($_POST["price"])
 || empty($_POST["currency"])
 || empty($_POST["description"]))) {
  header("Location: index.php");
}

$email = $POST["email"];
$token = $POST["stripeToken"];
$price = $POST["price"] * 100; // cents
$currency = strtolower($POST["currency"]); // eur
$description = urlencode($POST["description"]); // unique name(s)

$stripe_secret = STRIPE_SECRET_TEST;
$api_url = STRIPE_BASE_URL;

$create_customer = <<<SH
curl $api_url/customers \
  -u $stripe_secret \
  -d email="$email"
  -d source="$token"
SH;
$json_customer = shell_exec($create_customer);
$customer = json_decode($json_customer);

$create_charge = <<<SH
curl $api_url/charges \
  -u $stripe_secret \
  -d amount=$price \
  -d currency=$currency \
  -d description="$description" \
  -d source="$token"
SH;
$json_charge = shell_exec($create_charge);
$charge = json_decode($json_charge);

$customer_data = [
  "id" => $customer->id,
  "email" => $email
];
$db_customer = new Customer();
$db_customer->addCustomer($customer_data);

$transaction_data = [
  "id" => $charge->id,
  "customer_id" => $customer->id,
  "product_id" => $charge->description,
  "amount" => $charge->amount,
  "currency" => $charge->currency,
  "status" => $charge->status
];
$db_transaction = new Transaction();
$db_transaction->addCustomer($transaction_data);

$redirect_url = "success.php?tid=" . $charge->id;
$redirect_url .= "&p=" . urlencode($charge->description);
header("Location: " . $redirect_url);