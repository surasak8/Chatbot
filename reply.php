<?php
$access_token = 'xlXVh36v+sEMlz4rIXOWXbWByHp80zqXbDx6Mto+RoNJPlABzksW+JkVutpX8Q1NI7JqJJ0qdivpEvKAsv3TOOg4A+NgSQI45eP8Jk+4sh0oC7YC+zLc4I8k4ymyExbgR3PujpXghe+YR0emuPW5ewdB04t89/1O/w1cDnyilFU=';

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
			$text = $event['message']['text'];
			
			$chk_text = strtoupper ($text);
			if ($chk_text == '@HELP' || $chk_text == '@H') {
				$text = "@H - Help / @R - Register / @L - Login";
			} else
			if ($chk_text == '@R') {
				$text = "Click http://www.tnsitrade.com/register";
			} else
			if ($chk_text == '@L') {
				$text = "http://www.tnsitrade.com/login";
			} else
			if ($chk_text == 'MEAN') {
				$text = "Mean!!!, You are เทพๆ.";
			} else
			if ($chk_text == 'BOOM') {
				$text = "Boom!!!, Cat Woman.";
			} else
			if ($chk_text == 'TNS') {
				$text = "Thanachart Security.";
			} else {
				$text = $text . " เอ่อฉันขอคิดดูก่อนนะรอ...1 วัน...1เดือน...1 ปี"; 
			}
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

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
echo "OK";
?>
