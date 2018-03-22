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
			//***
			$textin_cmd = explode(':', $text_in); //เอาข้อความมาแยก : ได้เป็น Array        
			//***
			if($textin_cmd[0]=='สวัสดี')
			{
				$messages = [
					'type' => 'text',
					'text' => "ออเจ้า"
				];
				
			}
			elseif($textin_cmd[0]=='update')
			{
				$FIREBASE = "https://esp8266-temp.firebaseio.com/";
				$NODE_PATCH = "Lamp.json";
				$data = array(
    					$textin_cmd[1] => $textin_cmd[2]
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
					'text' => "เรียบร้อยแล้วครับเจ้านาย"
				];
			}			
			elseif($textin_cmd[0]=='สถานะ')
			{
				$FIREBASE = "https://esp8266-temp.firebaseio.com/";
				$NODE_GET = "Lamp.json";
				$curl = curl_init();
			 	curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_GET );
				curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
				$response = curl_exec( $curl );
				curl_close( $curl );
				//echo $response . "\n";
				$messages = [
					'type' => 'text',
					'text' => $response
				];

			}
			elseif($textin_cmd[0]=='1')
			{
				$messages = [
					"type"=> "sticker",
  					"packageId"=> "1",
  					"stickerId"=> "2581"
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
echo "sek";
?>
