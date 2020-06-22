<?php


function contactOtpGenerator($otp, $contact)
{
    $field = array(
        "sender_id" => "FSTSMS",
        "language" => "english",
        "route" => "qt",
        "numbers" => $contact,
        "message" => 28395,
        "variables" => "{#BB#}",
        "variables_values" => "$otp"
    );
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($field),
        CURLOPT_HTTPHEADER => array(
            "authorization:zTxe42WBDmPiCVaZugLOGR9UJo1KM8lnIjbXq7kEyp05NYh6HskZGvpuU23intb1Nlo0QF6RqXWVCDPy ",
            "cache-control: no-cache",
            "accept: */*",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        //echo "cURL Error #:" . $err;
        return false;
    } else {
        $result = json_decode($response,true);
        if ($result['return']) {
            return true;
        } else {
            return false;

        }
    }
}

