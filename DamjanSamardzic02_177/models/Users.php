<?php


class Users
{
    private $conn;

    public $id;
    public $username;
    public $password;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $sql = "SELECT * FROM user ORDER BY id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }


}