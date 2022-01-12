<?php 
$link_all="https://b24-66bf0p.bitrix24.by/rest/1/7ye8tcqu5hrcfu3x/crm.product.list.json";
$arr=json_decode(file_get_contents($link_all),true);
$arr_print = array();

for($i=0; $i<count($arr['result']); $i++) {
  $price = explode(".", $arr['result'][$i]['PRICE']);
  $add = [$arr['result'][$i]['NAME'], $arr['result'][$i]['DETAIL_PICTURE']['showUrl'], $price[0], $price[1]];
  $arr_print[$i] = $add;
  //echo $arr['result'][$i]['NAME']." - ".$price[0].":".$price[1]."<br>";
}
echo json_encode($arr_print);

?>