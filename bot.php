<?php
$access_token = 'ty0TFvqLwQLYO3/ZIyaxcOsXKeCITNiJpEn4g5QuMKTcLkwCp5GXeunc2jU0LylDXB49u7q+z4vpeTvc0BvJgGA9u1IIrR0Beus1eAW43uXIn2QD2NknBWkTYN8pHa+exkZfGKeUgajZzf/R+/qQUgdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text_in = $event['message']['text'];
			if($text_in=='สวัสดี')
			{
				$messages = 
				[
				 'type'=> 'sticker',
 				 'packageId'=> "2",
				 'stickerId'=> "149"				
			        ];	
			}
			elseif($text_in=='เปิดLED1')
			{
				$url = 'https://api.thingspeak.com/talkbacks/10962/commands/4117441.json?api_key=WFN45I92A9NN3S27';
				$data = array('command_string' => 'LED1=ON', 'position' => '2');

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
				$messages = "เปิดLED1แล้วครับเจ้านาย";
			}
			elseif($text_in=='ปิดLED1')
			{
				$url = 'https://api.thingspeak.com/talkbacks/10962/commands/4117441.json?api_key=WFN45I92A9NN3S27';
				$data = array('command_string' => 'LED1=OFF', 'position' => '2');

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
				$messages = "ปิดLED1แล้วครับเจ้านาย";
				
			}
			elseif($text_in=='เปิดLED2')
			{
				$url = 'https://api.thingspeak.com/talkbacks/10962/commands/4117582.json?api_key=WFN45I92A9NN3S27';
				$data = array('command_string' => 'LED2=ON', 'position' => '1');

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
				$messages = "เปิดLED2แล้วครับเจ้านาย";
			}
			elseif($text_in=='ปิดLED2')
			{
				$url = 'https://api.thingspeak.com/talkbacks/10962/commands/4117582.json?api_key=WFN45I92A9NN3S27';
				$data = array('command_string' => 'LED2=OFF', 'position' => '1');

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
				$messages = "ปิดLED2แล้วครับเจ้านาย";
				
			}
			elseif($text_in=='สถานะ')
			{
				$content = file_get_contents('https://api.thingspeak.com/talkbacks/10962/commands/4117582.json?api_key=WFN45I92A9NN3S27');
				$content="[".$content."]";		
				$events = json_decode($content, true);
				foreach ($events as $result) {
   					$status=$result["command_string"];
				}
				$messages = $status;
			}
			else
			{
				
				$messages = 
				[
				 'type'=> 'sticker',
 				 'packageId'=> "50",
				 'stickerId'=> "149"				
			        ];	
			}
			
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
				
				
				
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
	}
}
echo $result . "\r\n";
echo "OK";
