<?php
$arr1 = json_decode(file_get_contents("https://www.instagram.com/qdenya/?__a=1"), JSON_UNESCAPED_UNICODE); 
$body = json_encode($arr1, JSON_UNESCAPED_UNICODE);
$arr = json_decode($body, JSON_UNESCAPED_UNICODE);

print_r($arr);

?>