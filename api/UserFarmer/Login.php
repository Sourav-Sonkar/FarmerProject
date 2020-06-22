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
$row = "";
if (isset($data->type)&&!strcmp($data->type, "Farmer")) {
    $userFarmer->Mobile_Number = $data->Mobile_Number;
    $userFarmer->Password = md5($data->Password);
    $Farmer = $userFarmer->CheckNumberWithPassword();
    if ($Farmer->rowCount() == 1) {
        $row = $Farmer->fetch(PDO::FETCH_ASSOC);
        if ($row['verify_number'] == 1) {
            echo json_encode(
                array('message' => 'Success', 'Status' => 1,"verify"=> 1,'OTP' => '', 'id' => $row['id'], 'Farmer_name' => $row['Farmer_name'], 'Mobile_Number' => $row['Mobile_Number'])
            );
        } else {
            $otp = mt_rand(100000, 999999);
            if (contactOtpGenerator($otp, $userFarmer->Mobile_Number)) {
                echo json_encode(
                    array('message' => 'Success', 'Status' => 1, "verify"=> 0,'OTP' => $otp, 'id' => $row['id'], 'Farmer_name' => $row['Farmer_name'], 'Mobile_Number' => $row['Mobile_Number'])
                );
            }else {
                echo json_encode(
                    array('message' => 'OTP Not Sent', 'Status' => 0, "verify"=> 0,'OTP' => $row, 'id' =>$row, 'Farmer_name' =>$row, 'Mobile_Number' => $row)
                );
            }
        }
    } else {
        echo json_encode(
            array('message' => 'Invalid User', 'Status' => 0, "verify"=> 0,'OTP' => $row, 'id' =>$row, 'Farmer_name' =>$row, 'Mobile_Number' => $row)
        );
    }
} else {
    echo json_encode(
        array('message' => 'Invalid Request', 'Status' => 0, "verify"=> 0,'OTP' => $row, 'id' =>$row, 'Farmer_name' =>$row, 'Mobile_Number' => $row)
    );
}
?>