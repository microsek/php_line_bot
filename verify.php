<?php

$url = 'https://api.thingspeak.com/talkbacks/10962/commands.json?';
				$data = array('api_key' => 'WFN45I92A9NN3S27');
				$options = array(
    					'http' => array(
        				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        				'method'  => 'GET',
        				'content' => http_build_query($data)
    						)
				);
				$context  = stream_context_create($options);
				$result = file_get_contents($url, false, $context);
				if ($result === FALSE) { /* Handle error */ }
					var_dump($result);

$content = file_get_contents('php://input');
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			$text_in = $event['message']['text'];
		}
	}
}
echo $text_in;
