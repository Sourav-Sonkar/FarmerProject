<?php
class CropRequire {
    // DB Stuff
    private $conn;
    private $table = 'crop_requirement';

    // Properties
    public $id;
    public $Crop_Name;
    public $Market_Crop_Price;
    public $Contact;
    public $Quantity;
    
    
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    public function AddCrop(){
        // Create query
        $this->verify_number=0;
        $query = 'INSERT INTO ' . $this->table . ' SET Crop_Name =:Crop_Name,Market_Crop_Price =:Market_Crop_Price, Contact = :Contact,
        Quantity = :Quantity';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Clean data
        
        // Bind data
        $stmt->bindParam(':Crop_Name', $this->Crop_Name);
        $stmt->bindParam(':Market_Crop_Price', $this->Market_Crop_Price);
        $stmt->bindParam(':Contact', $this->Contact);
        $stmt->bindParam(':Quantity', $this->Quantity);
        // Execute query
        if($stmt->execute()) {
          return true;
        }  
        // Print error if something goes wrong
        //printf("Error: %s.\n", $stmt->error);
  
        return false;
  
    }
    public function CheckId()
    {
        $query = 'Select *  from  ' . $this->table . ' WHERE id = :id ';
        //$message = null;
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo  $message = $e->getmessage();
        }
        return $stmt;
    }
    

    public function DeleteCrop(){
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false; 

    }
    public function read() {
        // Create query
        $query = 'SELECT * FROM '.$this->table ;
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
    }
  
   
}
?> 

