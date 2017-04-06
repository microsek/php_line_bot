
<?php

$data = array("LED1" => 55);
        $ch = curl_init("https://esp8266-temp.firebaseio.com/Lamp.json");
 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
 
        $response = curl_exec($ch);
        if(!$response) {
            return false;
        }

echo "OK";
