<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$appdata = json_decode(file_get_contents("php://input"));
$weather_array = array();

if (isset($appdata->lat) && isset($appdata->lon)) {
    $api_link = "http://api.openweathermap.org/data/2.5/forecast?lat=" . $appdata->lat . "&lon=" . $appdata->lon . "&appid=7d1b1c5700856626d2c89b386e0c5e8b&units=metric";
    $data = json_decode(file_get_contents($api_link));
    $count = 0;
    if (isset($data->cod)&&$data->cod == 200) {
        foreach ($data->list as $singleData) {
            if ($count == 0 || $count == 8 || $count == 16 || $count == 24 || $count == 32) {
                $date = new DateTime($singleData->dt_txt);
                $new_date_format = $date->format('Y-m-d');
                $daily_weather = array(
                    "dt_txt" => $new_date_format,
                    "day_txt"=>$date->format('l'),
                    "feels_like" => $singleData->main->feels_like,
                    "temp_min" => $singleData->main->temp_min,
                    "temp_max" => $singleData->main->temp_max,
                    "pressure" => $singleData->main->pressure,
                    "humidity" => $singleData->main->humidity,
                    "main" => $singleData->weather[0]->main,
                    "description" => $singleData->weather[0]->description,
                    "speed" => $singleData->wind->speed,
                );
                array_push($weather_array, $daily_weather);
            }
            $count++;
        }
        echo json_encode(array("status" => 1, "weather" => $weather_array, "city" => array("City" => empty($data->city->name)?"":$data->city->name, "Country" => empty($data->city->country)?"":$data->city->country)));
    } else {
        echo json_encode(array("status" => 0, "weather" => $weather_array, "city" => array()));
    }
} else {
    echo json_encode(array("status" => 0, "weather" => $weather_array, "city" => array()));
}
?>