<?php
/*
Insta-galery v1.0
Author: Denis Drobysh
Instagram: @qdenya 
*/
const TOKEN = "IGQVJYQ19QOEx2VWNRSS1Nc3lfeWQwaVo0ZA2xyNGxVZAHRReWFJRk12WnY3TlNNWEYwNzgzT3VTUnNqMnRUZAm1LcVVhVXJnaG55b0FwMkZAFeUpvM0VoOXBJRmpDV3JHSU5SUXowcU1kWTBuWGFxLWdZAZAAZDZD"; //Access token: Никому не давайте давнный ключ
const FIELDS = "id,media_type,media_url,caption,timestamp,thumbnail_url,permalink";
const NUM_OF_POSTS = "6"; //Количество постов на вывод в галерее

$body1 = file_get_contents('https://graph.instagram.com/me/media?fields='.FIELDS.'&access_token='.TOKEN);
//header('Content-Type: text/html; charset=utf-8');
$arr1 = json_decode($body1, JSON_UNESCAPED_UNICODE); 
$body = json_encode($arr1['data'], JSON_UNESCAPED_UNICODE);
$arr = json_decode($body, JSON_UNESCAPED_UNICODE);

$new = array();

for($i=0; $i<NUM_OF_POSTS; $i++) {
  array_push($new, $arr[$i]);
}
print_r(json_encode($new,JSON_UNESCAPED_UNICODE));


?>