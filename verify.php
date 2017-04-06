<?php
$FIREBASE = "https://esp8266-temp.firebaseio.com";
$NODE_PUT = "Lamp.json";
$data = 32;
$data = array(
    "LED1" => 42
);
$json = json_encode( $data );

$curl = curl_init();

curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
$response = curl_exec( $curl );
curl_close( $curl );
echo $response . "\n";
?>
