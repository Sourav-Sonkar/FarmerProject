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
$MandiCrop->id = isset($data->id)?$data->id:"";
if (($MandiCrop->CheckId())->rowCount()>0) {
    if ($MandiCrop->DeleteMandiPrice()) {
        echo json_encode(array("Status" => 1, "message" => "Success"));
    } else {
        echo json_encode(array("Status" => 0, "message" => "Failure"));
    }
}else {
    echo json_encode(array("Status" => 0, "message" => "Invalid Id"));
}
?>