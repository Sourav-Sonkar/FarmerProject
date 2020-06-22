<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Database.php';
include_once '../../models/UserFarmer.php';
include_once '../../models/OtpGenerator.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$userFarmer = new UserFarmer($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$userFarmer->Mobile_Number = isset($data->Mobile_Number)?$data->Mobile_Number:"";
$Farmer=$userFarmer->CheckNumber();
$otp="";
if($Farmer->rowCount()==1){
    $otp = mt_rand(100000, 999999);
    if (contactOtpGenerator($otp, $userFarmer->Mobile_Number)) {
      echo json_encode(
        array('message' => 'Success', 'Status' => 1, 'OTP' => $otp)
      );
    } else {
      echo json_encode(
        array('message' => 'Something went Wrong','Status' => 0, 'OTP' => $otp)
      );
    }
}else{
    echo json_encode(
        array('message' => 'Invalid User', 'Status' => 0,'OTP' => $otp)
    );   
}
?>