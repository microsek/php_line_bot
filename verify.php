<?php
// Get POST body content
$content = file_get_contents('https://api.thingspeak.com/talkbacks/10962/commands.json?api_key=WFN45I92A9NN3S27');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'command_string' && $event['message']['type'] == 'text') {
			// Get text sent
			$text_in = $event['command_string']['text'];
			// Get replyToken
			
			echo $text_in . "\r\n";
		}
	}
}
echo "OK";
