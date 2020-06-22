<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Database.php';
include_once '../../models/UserFarmer.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$userFarmer = new UserFarmer($db);
$data = json_decode(file_get_contents("php://input"));
$Status = $data->Status;
$userFarmer->Mobile_Number = $data->Mobile_Number;
if($Status==1){
    if (($userFarmer->CheckNumber())->rowCount() == 1) {
        if($userFarmer->VerifyNumber()){
            echo json_encode(
                array('message' => 'Success', 'Status' => 1)
            );
        }else{
            echo json_encode(
                array('message' => 'Faiure', 'Status' => 0)
            );
        }
    }
}

