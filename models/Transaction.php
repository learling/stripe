<?php
class Transaction {
  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function addCustomer($data) {
    $sql = <<<SQL
INSERT INTO transactions 
(id, customer_id, product_id, amount, currency, status) 
VALUES(:id, :customer_id, :product_id, :amount, :currency, :status);
SQL;
    $this->db->query($sql);
    $this->db->bind(":id", $data["id"]);
    $this->db->bind(":customer_id", $data["customer_id"]);
    $this->db->bind(":product_id", $data["product_id"]);
    $this->db->bind(":amount", $data["amount"]);
    $this->db->bind(":currency", $data["currency"]);
    $this->db->bind(":status", $data["status"]);

    if ($this->db->execute()) {
      return true;
    }
    return false;
  }
}