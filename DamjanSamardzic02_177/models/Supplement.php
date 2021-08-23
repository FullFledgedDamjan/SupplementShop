<?php
class Supplement{
   private $con;
   private $table='suplements';

   public $id;
   public $name;
   public $price;
   public $company;
   public $user;
   public $supplementType;

   public function __construct($db)
   {
       $this->con=$db;

   }


   public function read(){
       $query='SELECT     
       s.id,
       s.name,
       s.price,
       c.name as company_name,
       s.user,
       s.supplementType
       FROM '.$this->table. ' s 
       LEFT JOIN company c ON s.company =c.id
       ORDER BY
       s.price DESC';


       $stmt =$this->con->prepare($query);
       $stmt->execute();
       return $stmt;

   }

    public function readSupplier(){
        $query='SELECT     
       s.id,
       s.user,
       s.supplement
       FROM supplier s 
      ';


        $stmt =$this->con->prepare($query);
        $stmt->execute();
        return $stmt;

    }

   public function read_single(){
       $query='SELECT     
       s.id,
       s.name,
       s.price,
       c.name as company_name,
       s.user,
       s.supplementType
       FROM '.$this->table. ' s 
       LEFT JOIN company c ON s.company =c.id
       WHERE s.name=?
       LIMIT 0,1';

       $stmt =$this->con->prepare($query);
       $stmt->bindParam(1,$this->name);

       $stmt->execute();

       $row=$stmt->fetch(PDO::FETCH_ASSOC);
       $this->id=$row['id'];
       $this->name=$row['name'];
       $this->price=$row['price'];
       $this->company_name=$row['company_name'];
       $this->user=$row['user'];
       $this->supplementType=$row['supplementType'];
   }
    public function create() {
        $query = 'INSERT INTO suplements SET name = :name, price = :price, company = :company,user= :user ,supplementType= :supplementType';

        //Prepare statement
        $stmt = $this->con->prepare($query);

        //Clean data
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->company=htmlspecialchars(strip_tags($this->company));
        $this->user=htmlspecialchars(strip_tags($this->user));
        $this->supplementType=htmlspecialchars(strip_tags($this->supplementType));

        //Bind data
        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':price',$this->price);
        $stmt->bindParam(':company',$this->company);
        $stmt->bindParam(':user',$this->user);
        $stmt->bindParam(':supplementType',$this->supplementType);

        //Execute query
        if($stmt->execute()) {
            return true;
        }

        //Print error if smt goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }


   public function add(){
       $query=' INSERT INTO ' .$this->table. '
       SET 
        name=:name,
        price=:price,
        company=:company,
        user=:user,
        supplementType=:supplementType';

       $stmt=$this->con->prepare($query);

       $this->name=htmlspecialchars(strip_tags($this->name));
       $this->price=htmlspecialchars(strip_tags($this->price));
       $this->company=htmlspecialchars(strip_tags($this->company));
       $this->user=htmlspecialchars(strip_tags($this->user));
       $this->supplementType=htmlspecialchars(strip_tags($this->supplementType));

       $stmt->bindParam(':name',$this->name);
       $stmt->bindParam(':price',$this->price);
        $stmt->bindParam(':company',$this->company);
       $stmt->bindParam(':user',$this->user);
       $stmt->bindParam(':supplementType',$this->supplementType);

       if($stmt->execute()){
        return true;

       }
    printf("error: %s.\n", $stmt->eroor);
    return false;
   }

    public function update(){
            $query=' UPDATE ' .$this->table. '
           SET          
            name=:name,
            price=:price,
            company=:company,           
            supplementType=:supplementType
            WHERE 
            id=:id';

        $stmt=$this->con->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->company=htmlspecialchars(strip_tags($this->company));
     //   $this->user=htmlspecialchars(strip_tags($this->user));
        $this->supplementType=htmlspecialchars(strip_tags($this->supplementType));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':price',$this->price);
        $stmt->bindParam(':company',$this->company);
     //   $stmt->bindParam(':user',$this->user);
        $stmt->bindParam(':supplementType',$this->supplementType);
        $stmt->bindParam(':id',$this->id);

        if($stmt->execute()){
            return true;

        }
        printf("error: %s.\n", $stmt->eroor);
        return false;
    }



    public function delete(){
        $ratingQuery = 'DELETE FROM supplier WHERE supplement = :id';

        $stmt = $this->con->prepare($ratingQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();


       $query='DELETE FROM ' .$this->table. ' WHERE id=:id';

        $stmt=$this->con->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id',$this->id);

        if($stmt->execute()){
            return true;

        }
        printf("error: %s.\n", $stmt->eroor);
        return false;
    }

    public function deleteZ(){
        $ratingQuery = 'DELETE FROM supplier WHERE supplement = :id';

        $stmt = $this->con->prepare($ratingQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();


//       $query='DELETE FROM ' .$this->table. ' WHERE id=:id';
//
//        $stmt=$this->con->prepare($query);
//
//        $this->id=htmlspecialchars(strip_tags($this->id));
//
//        $stmt->bindParam(':id',$this->id);

        if($stmt->execute()){
            return true;

        }
        printf("error: %s.\n", $stmt->eroor);
        return false;
    }


    public function info(){

       $query='SELECT s.name AS name,c.name as company, o.name AS origin,c.name AS producer, u.username AS seller,s.price AS price
                FROM '.$this->table. ' s,origin o, user u,company c,supplier sup 
                WHERE s.supplementType = o.id AND s.company = c.id AND s.user=u.id AND sup.supplement=s.id AND sup.user=:id';

        $stmt =$this->con->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id',$this->id);

        $stmt->execute();
        return $stmt;
    }

    public function infoSold(){
        $query = 'SELECT s.name AS name,c.name AS producer, o.name AS origin, u2.username AS buyer,s.price AS price
                FROM suplements s,origin o, user u,company c,supplier sup,user u2
                WHERE s.supplementType = o.id AND s.company = c.id AND s.user = u.id AND u2.id=sup.user AND sup.supplement=s.id AND s.user=:id';


//
//        $query='SELECT s.name AS name,c.name as company, o.name AS origin,c.name AS producer, u.username AS seller,s.price AS price
//                FROM '.$this->table. ' s,origin o, user u,company c,supplier sup
//                WHERE s.supplementType = o.id AND s.company = c.id AND s.user=u.id AND sup.supplement=s.id AND sup.user=:id';

        $stmt =$this->con->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id',$this->id);

        $stmt->execute();
        return $stmt;
    }

//    public function androidInfo(){
//
//        $query='SELECT s.name AS name, o.name AS origin,c.name AS producer, u.username AS seller,s.price AS price
//                FROM '.$this->table. ' s,origin o, user u,company c,supplier sup
//                WHERE s.supplementType = o.id AND s.company = c.id AND s.user = u.id AND sup.supplement=s.id AND sup.user=:id AND u.id>0' ;
//
//        $stmt =$this->con->prepare($query);
//
//        $this->id=htmlspecialchars(strip_tags($this->id));
//
//        $stmt->bindParam(':id',$this->id);
//
//        $stmt->execute();
//        return $stmt;
//    }

    public function androidInfo(){

        $query='SELECT s.name AS name, o.name AS origin,c.name AS producer, u.username AS seller,s.price AS price
                FROM '.$this->table. ' s,origin o, user u,company c,supplier sup 
                ' ;

        $stmt =$this->con->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));



        $stmt->execute();
        return $stmt;
    }


    public function buyInfo(){
        $query='SELECT name, price FROM '.$this->table. ' WHERE id=:id';

        $stmt =$this->con->prepare($query);
        $stmt->bindParam(':id',$this->id);

        $stmt->execute();

        return $stmt;

    }
}