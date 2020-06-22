<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

include_once '../../Database.php';
include_once '../../models/CropRequiremnet.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$crop=new CropRequire($db);

  $result = $crop->read();
  $num = $result->rowCount();
  $crop_list=array();
    if($num>0){
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($crop_list,$row);
        }
        echo json_encode(array("Status"=>1,"message"=>"Success","CropList"=>$crop_list));       
    }else{
        echo json_encode(array("Status"=>0,"message"=>"Failure","CropList"=>$crop_list));       
    }
?>
  