<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

include_once '../../Database.php';
include_once '../../models/CropRequiremnet.php';

// Instantiate DB & connect
include_once '../../models/MandiPrice.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$MandiCrop=new MandiPrice($db);

  $result = $MandiCrop->read();
  $num = $result->rowCount();
  $MandiCrop_list=array();
    if($num>0){
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($MandiCrop_list,$row);
        }
        echo json_encode(array("Status"=>1,"message"=>"Success","MandiPriceList"=>$MandiCrop_list));       
    }else{
        echo json_encode(array("Status"=>0,"message"=>"Failure","MandiPriceList"=>$MandiCrop_list));       
    }
?>
  