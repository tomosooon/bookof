<?php
// .json -> .chainにする処理を書く

$json = file_get_contents('./sample_data.json');
$arr = json_decode($json, true);

$writeFile = 'sample_data.chain';

$content = "";
foreach ($arr as $value) {

  $content .= json_encode($value)."\n";
}
file_put_contents($writeFile, $content);

?>
