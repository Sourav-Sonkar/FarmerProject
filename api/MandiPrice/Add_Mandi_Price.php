<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Database.php';
include_once '../../models/MandiPrice.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$MandiCrop=new MandiPrice($db);

$data = json_decode(file_get_contents("php://input"));
$MandiCrop->Crop_Name=$data->Crop_Name;
$MandiCrop->image_link=$data->image_link;
$MandiCrop->Price=$data->Price;

if($MandiCrop->AddMandiCrop()){
    echo json_encode(
        array('message' => 'Success', 'Status' => 1)
    );
}else{
    echo json_encode(
        array('message' => 'Failure', 'Status' => 0)
    );
}
?>
