<?php 
$start = 348;
$end = 473;
$file = array();

for($i = $start; $i<$end; $i = $i + 2) {
  $link_all="https://lbts.bitrix24.by/rest/1/7ye8tcqu5hrcfu3x/crm.product.get?id=".$i;
  $arr=json_decode(file_get_contents($link_all),true);

  $price = explode(".", $arr['result']['PRICE']);
  $new_price = explode(".", $arr['result']['PROPERTY_156']['value']);

  $new_item = array(
    'id' => $arr['result']['ID'],
    'title' => $arr['result']['NAME'],
    'brand' => $arr['result']['PROPERTY_152']['value'],
    'link' => $arr['result']['CODE'],
    'photo' => $arr['result']['XML_ID'],
    'price' => array($price[0], $price[1]),
    'promo' => array(
        'discount' => $arr['result']['PROPERTY_154']['value'],
        'new_price' => array($new_price[0], $new_price[1])
    )
  );

  if($file[$arr['result']['PROPERTY_152']['value']]) {
    array_push($file[$arr['result']['PROPERTY_152']['value']], $new_item);
  } else {
    $file[$arr['result']['PROPERTY_152']['value']] = array($new_item);
  }
  

}

file_put_contents('my.json', json_encode($file));
echo json_encode($file);


// $link_all="https://b24-66bf0p.bitrix24.by/rest/1/7ye8tcqu5hrcfu3x/crm.product.list.json";
// $arr=json_decode(file_get_contents($link_all),true);
// $arr_print = array();

// for($i=0; $i<count($arr['result']); $i++) {
//   $price = explode(".", $arr['result'][$i]['PRICE']);
//   $add = [$arr['result'][$i]['NAME'], $arr['result'][$i]['DETAIL_PICTURE']['showUrl'], $price[0], $price[1]];
//   $arr_print[$i] = $add;
//   //echo $arr['result'][$i]['NAME']." - ".$price[0].":".$price[1]."<br>";
// }
// echo json_encode($arr_print);

?>