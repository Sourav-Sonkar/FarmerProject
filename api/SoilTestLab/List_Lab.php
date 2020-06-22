<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../Database.php';
  include_once '../../models/SoilTestLab.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $Soil_Lab = new SoilTest($db);

  $result = $Soil_Lab->read();
  $num = $result->rowCount();
  $lab_list=array();
    if($num>0){
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($lab_list,$row);
        }
        echo json_encode(array("Status"=>1,"message"=>"Success","responseData"=>$lab_list));       
    }else{
        echo json_encode(array("Status"=>0,"message"=>"Failure","responseData"=>$lab_list));       
    }
?>
  