<?php
class Supplier{
    private $con;
    private $table='supplier';

    public $id;
    public $user;
    public $supplement;

    public function __construct($db)
    {
        $this->con=$db;

    }

    public function buy(){


        $query='INSERT INTO ' .$this->table. '
         SET
         
         user=:user,
         supplement=:supplement';


        $stmt=$this->con->prepare($query);


        $this->user=htmlspecialchars(strip_tags($this->user));
        $this->supplement=htmlspecialchars(strip_tags($this->supplement));

        $stmt->bindParam(':user',$this->user);
        $stmt->bindParam(':supplement',$this->supplement);

        if($stmt->execute()){
            return true;

        }
        printf("error: %s.\n", $stmt->eroor);
        return false;
    }
}