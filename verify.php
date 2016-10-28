<?php
$url = 'https://api.thingspeak.com/talkbacks/10962/commands/2920959.json?api_key=WFN45I92A9NN3S27';
$data = array('command_string' => '123', 'position' => '1');
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'PUT',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
var_dump($result);
?>
