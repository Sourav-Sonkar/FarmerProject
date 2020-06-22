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

$crop=new CropRequire($db);

$data = json_decode(file_get_contents("php://input"));
$crop->Crop_Name=$data->Crop_Name;
$crop->Quantity=$data->Quantity;
$crop->Contact=$data->Contact;
$crop->Market_Crop_Price=$data->Market_Crop_Price;

if($crop->AddCrop()){
    echo json_encode(
        array('message' => 'Success', 'Status' => 1)
    );
}else{
    echo json_encode(
        array('message' => 'Failure', 'Status' => 0)
    );
}
?>
