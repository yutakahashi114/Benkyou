<?php

$word = 'ABC';
$rot = 13;

// 暗号化
$array = str_split($word);
$result = [];
foreach ($array as $value) {
    $asc = ord($value) + $rot;
    $asc = ($asc - 65) % 26 + 65;
    $asc = chr($asc);
    $result[] = $asc;
}
$enc = implode($result);
var_dump($enc);


// 解読
$array = str_split($enc);
$result = [];
foreach ($array as $value) {
    $asc = ord($value) - $rot;
    $asc = ($asc - 65) % 26 + 65;
    $asc = chr($asc);
    $result[] = $asc;
}
$dec = implode($result);
var_dump($dec);
