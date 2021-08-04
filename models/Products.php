<?php
class Products {
  private $db;

  public function __construct() {
    $this->db = new Database();
  }

  public function listActives() {
    $this->db->query("SELECT * FROM products WHERE active = 1");
		return $this->db->resultset();
  }
}