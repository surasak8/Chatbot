<?php
$access_token = 'xlXVh36v+sEMlz4rIXOWXbWByHp80zqXbDx6Mto+RoNJPlABzksW+JkVutpX8Q1NI7JqJJ0qdivpEvKAsv3TOOg4A+NgSQI45eP8Jk+4sh0oC7YC+zLc4I8k4ymyExbgR3PujpXghe+YR0emuPW5ewdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

?>
