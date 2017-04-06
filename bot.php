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
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			if($text_in=='สวัสดี')
			{
				$messages = 
				[
				 'type'=> 'sticker',
 				 'packageId'=> "2",
				 'stickerId'=> "1"				
			        ];	
			}
			elseif($text_in=='เปิดLED1')
			{
				$FIREBASE = "https://esp8266-temp.firebaseio.com/";
				$NODE_PATCH = "Lamp.json";
				$data = array(
    					"LED1" => 1
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
				$messages = [
					'type' => 'text',
					'text' => "เปิดLED1แล้วครับเจ้านาย"
				];
			}
			elseif($text_in=='เปิดLED2')
			{
				$FIREBASE = "https://esp8266-temp.firebaseio.com/";
				$NODE_PATCH = "Lamp.json";
				$data = array(
    					"LED2" => 1
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
				$messages = [
					'type' => 'text',
					'text' => "เปิดLED2แล้วครับเจ้านาย"
				];
			}
			elseif($text_in=='ปิดLED1')
			{
				$FIREBASE = "https://esp8266-temp.firebaseio.com/";
				$NODE_PATCH = "Lamp.json";
				$data = array(
    					"LED1" => 0
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
				$messages = [
					'type' => 'text',
					'text' => "ปิดLED1แล้วครับเจ้านาย"
				];

			}
			elseif($text_in=='ปิดLED2')
			{
				$FIREBASE = "https://esp8266-temp.firebaseio.com/";
				$NODE_PATCH = "Lamp.json";
				$data = array(
    					"LED2" => 0
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
				$messages = [
					'type' => 'text',
					'text' => "ปิดLED2แล้วครับเจ้านาย"
				];
				
			}
			elseif($text_in=='สถานะ')
			{
				$json = file_get_contents('https://esp8266-temp.firebaseio.com/Lamp.jason');
				$array = json_decode($json);

				$urlPoster=array();
				foreach ($array as $value) { 
    					$urlPoster[]=$value->urlPoster;
				}
				$messages = [
					'type' => 'text',
					'text' => $urlPoster
				];

			}
			else
			{
				
				$messages = 
				[
				 'type'=> 'sticker',
 				 'packageId'=> "2",
				 'stickerId'=> "149"				
			        ];	

			}
			
			
			
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
echo "OK";
