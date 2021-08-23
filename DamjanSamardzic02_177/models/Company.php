<?php


class Company
{
    private $conn;

    public $id;
    public $name;
    public $country;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function read() {
        $sql = "SELECT * FROM company ORDER BY id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }
}