<?php
// .chain ⇒ 各モデルに変換

# chainの読み込み処理
$file = fopen(CHAINPATH,"r");
$arr = [];
if ($file) {
  while($line = fgets($file)) {
    $arr[] = json_decode($line, true);
  }
}
fclose($file);

echo "-----------------------\n";
$transactionsList = array_map(function($value) {
  return $value['transactions'];
}, $arr);

$transactions = array_reduce($transactionsList, function($carry, $item) {
  return array_merge($carry, $item);
}, []);

# chainのモデルへの変換

var_dump($transactions);

?>
