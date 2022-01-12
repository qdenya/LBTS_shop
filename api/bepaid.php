<?php

$body1 = file_get_contents('php://input');
//header('Content-Type: text/html; charset=utf-8');
$arr1 = json_decode($body1, JSON_UNESCAPED_UNICODE); 
$body = json_encode($arr1, JSON_UNESCAPED_UNICODE);
$arr = json_decode($body, JSON_UNESCAPED_UNICODE);

$fp = fopen("clipboard.txt", "a+");
fwrite($fp, date('d.m.Y H:i:s')."\r\n".$body."\r\n".$body1."\r\n".json_encode($_SERVER)."\r\n\r\n");
file_put_contents($_SERVER['DOCUMENT_ROOT']."/receipts/".$arr['transaction']['uid'].".pdf", fopen($arr['transaction']['receipt_url'].".pdf", 'r'));

header('Location: https://b24-66bf0p.bitrix24.by/bitrix/tools/sale_ps_result.php');
header("HTTP/1.0 200 OK");
echo "ok";


?>