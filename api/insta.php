<?php

$body1 = file_get_contents('https://graph.instagram.com/me/media?fields=id,media_type,media_url,caption,timestamp,thumbnail_url,permalink&access_token=IGQVJWWXpOSlNqOXZApRUVhZAGNkTTZACb2FJM0pPU3RWOGpDR1gxaXdtUHkwTERWVi03RVV0NUU2bnMxeEM1empxbkl4MFdjNHE5MXc2ZAXlBLXQyNTFvSXM1YjgzWWJmMldWRW9KS2t4NWNqblc1enU5dgZDZD');
//header('Content-Type: text/html; charset=utf-8');
$arr1 = json_decode($body1, JSON_UNESCAPED_UNICODE); 
$body = json_encode($arr1['data'], JSON_UNESCAPED_UNICODE);
$arr = json_decode($body, JSON_UNESCAPED_UNICODE);

print_r($body);


?>