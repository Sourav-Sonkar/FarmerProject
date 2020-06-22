<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../Database.php';
  include_once '../../models/ToolList.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $tool = new ToolList($db);

  $result = $tool->read();
  $num = $result->rowCount();
  $tool_list=array();
    if($num>0){
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($tool_list,$row);
        }
        echo json_encode(array("Status"=>1,"message"=>"Success","ToolList"=>$tool_list));       
    }else{
        echo json_encode(array("Status"=>0,"message"=>"Failure","ToolList"=>$tool_list));       
    }
?>
  