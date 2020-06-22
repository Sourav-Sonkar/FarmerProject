<?php
class SoilTest {
    // DB Stuff
    private $conn;
    private $table = 'soil_test_labs';

    // Properties
    public $id;
    public $Name;
    public $Address;
    public $Contact;
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
  
   
}
?> 

