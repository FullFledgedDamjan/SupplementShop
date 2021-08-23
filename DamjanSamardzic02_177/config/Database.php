<?php
class Database{

    private $server = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $baza = 'gym';
    private $con;


    public function connect()
    {
        $this->con = null;
        try {

            $this->con = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->baza, $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connectionz Error ' . $e->getMessage();
        }
        return $this->con;
    }


}