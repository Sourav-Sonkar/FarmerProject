<?php
class MandiPrice {
    // DB Stuff
    private $conn;
    private $table = 'mandi_price';

    // Properties
    public $id;
    public $Crop_Name;
    public $Price;
    public $image_link;
    
    
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
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
    
    public function DeleteMandiPrice(){
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
    
    public function AddMandiCrop(){
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET Crop_Name =:Crop_Name,Price =:Price, image_link = :image_link';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Clean data
        
        // Bind data
        $stmt->bindParam(':Crop_Name', $this->Crop_Name);
        $stmt->bindParam(':Price', $this->Price);
        $stmt->bindParam(':image_link', $this->image_link);
        // Execute query
        if($stmt->execute()) {
          return true;
        }  
        // Print error if something goes wrong
        //printf("Error: %s.\n", $stmt->error);
  
        return false;
  
    }    
}
?> 

