<?php
class Products {
  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function listAll() {
    $this->db->query("SELECT * FROM products");
		return $this->db->resultset();
  }
}