<?php
  class UserFarmer {
    // DB Stuff
    private $conn;
    private $table = 'user';

    // Properties
    public $id;
    public $Farmer_name;
    public $Mobile_Number;
    public $Email;
    public $Password;
    public $verify_number;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    public function CheckNumberWithPassword()
    {
        $query = 'Select *  from  ' . $this->table . ' WHERE Mobile_Number = :Mobile_Number and Password = :Password ';
        //$message = null;
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':Mobile_Number', $this->Mobile_Number);
            $stmt->bindParam(':Password', $this->Password);
            $stmt->execute();
        } catch (PDOException $e) {
            echo  $message = $e->getmessage();
        }
        return $stmt;
    }
    public function CheckNumber()
    {
        $query = 'Select *  from  ' . $this->table . ' WHERE Mobile_Number = :Mobile_Number ';
        //$message = null;
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':Mobile_Number', $this->Mobile_Number);
            $stmt->execute();
        } catch (PDOException $e) {
            echo  $message = $e->getmessage();
        }
        return $stmt;
    }
    public function UpdatePassword(){
      $query = 'UPDATE ' . $this->table . ' SET Password = :Password WHERE Mobile_Number = :Mobile_Number';
          // Prepare statement
          $stmt = $this->conn->prepare($query);
          // Clean data
          $stmt->bindParam(':Password', $this->Password);
          $stmt->bindParam(':Mobile_Number', $this->Mobile_Number);
          // Execute query
          if($stmt->execute()) {
            return true;
          }
          // Print error if something goes wrong
          //printf("Error: %s.\n", $stmt->error);
          return false;
    }
    public function VerifyNumber(){
      $this->verify_number=1;
      $query = 'UPDATE ' . $this->table . '
                                SET verify_number =:verify_number
                                WHERE Mobile_Number = :Mobile_Number';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $stmt->bindParam(':verify_number', $this->verify_number);
          $stmt->bindParam(':Mobile_Number', $this->Mobile_Number);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;

    }
    
    public function SignUp(){
      // Create query
      $this->verify_number=0;
      $query = 'INSERT INTO ' . $this->table . ' SET Password =:Password,verify_number =:verify_number, Farmer_name = :Farmer_name, Mobile_Number = :Mobile_Number, Email = :Email';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      
      // Bind data
      $stmt->bindParam(':Farmer_name', $this->Farmer_name);
      $stmt->bindParam(':Mobile_Number', $this->Mobile_Number);
      $stmt->bindParam(':Email', $this->Email);
      $stmt->bindParam(':Password', $this->Password);
      $stmt->bindParam(':verify_number', $this->verify_number);
      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;

    } 
  }
?>
