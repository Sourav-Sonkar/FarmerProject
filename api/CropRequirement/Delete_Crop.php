<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Database.php';
include_once '../../models/CropRequiremnet.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$crop = new CropRequire($db);

$data = json_decode(file_get_contents("php://input"));
$crop->id = isset($data->id)?$data->id:"";
if (($crop->CheckId())->rowCount()>0) {
    if ($crop->DeleteCrop()) {
        echo json_encode(array("Status" => 1, "message" => "Success"));
    } else {
        echo json_encode(array("Status" => 0, "message" => "Failure"));
    }
}else {
    echo json_encode(array("Status" => 0, "message" => "Invalid Id"));
}
?>