<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../Database.php';
  include_once '../../models/PestShop.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $Soil_Lab = new PestShop($db);

  $result = $Soil_Lab->read();
  $num = $result->rowCount();
  $Shop_list=array();
    if($num>0){
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if($row['Contact']=="0"){
                $row['Contact']="Not Available";
            }
            array_push($Shop_list,$row);
        }
        echo json_encode(array("Status"=>1,"message"=>"Success","responseData"=>$Shop_list));       
    }else{
        echo json_encode(array("Status"=>0,"message"=>"Failure","responseData"=>$Shop_list));       
    }
?>
  