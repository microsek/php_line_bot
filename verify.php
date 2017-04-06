<?php
    $FIREBASE = "https://esp8266-temp.firebaseio.com/";
	$NODE_PATCH = "Lamp.json";
	$data = array(
    		$_POST=['node'] => $_POST=['cmd']
	);
	$json = json_encode( $data );
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PATCH );
	curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PATCH" );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
	$response = curl_exec( $curl );
	curl_close( $curl );
	echo $response . "\n";
?>
