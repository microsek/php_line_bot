<?php
$access_token = 'ty0TFvqLwQLYO3/ZIyaxcOsXKeCITNiJpEn4g5QuMKTcLkwCp5GXeunc2jU0LylDXB49u7q+z4vpeTvc0BvJgGA9u1IIrR0Beus1eAW43uXIn2QD2NknBWkTYN8pHa+exkZfGKeUgajZzf/R+/qQUgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

