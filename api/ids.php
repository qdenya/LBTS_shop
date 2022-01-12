<?php 
$start = 348;
$end = 473;

for($i = $start; $i<$end; $i = $i + 2) {
  $link_all="https://lbts.bitrix24.by/rest/1/7ye8tcqu5hrcfu3x/crm.product.get?id=".$i;
  $arr=json_decode(file_get_contents($link_all),true);

  echo "https://lbts.by/katalog/item/".$arr['result']['CODE']."<br>";  

}


?>