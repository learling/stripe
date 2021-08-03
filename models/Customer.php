<?php
class Customer {
  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function addCustomer($data) {
    $this->db->query("INSERT INTO customers (id, email) VALUES(:id, :email)");

    $this->db->bind(":id", $data["id"]);
    $this->db->bind(":email", $data["email"]);

    if ($this->db->execute()) {
      return true;
    }
    return false;
  }
}