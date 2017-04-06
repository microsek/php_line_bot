
<?php
$url = 'https://esp8266-temp.firebaseio.com/LED.json';
$data = array("LED" => 55);
$options = array(
	'http' => array(
	'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	'method'  => 'PUT',
	'content' => http_build_query($data))
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
	var_dump($result);
echo "OK";
