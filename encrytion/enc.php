<?php

$word = 'qwerty';

// 暗号化

// 文字列を1文字づつ配列の要素に変換
$array = str_split($word);
$result = [];
foreach ($array as $value) {
    // 文字をASCIIコードに変換
    $asc = ord($value);
    // ASCIIコードを2進数に変換
    $binary = decbin($asc);
    // 7桁になるように0を詰める
    $binary = str_pad($binary, 7, "0", STR_PAD_LEFT);
    // 2進数を1桁づつ配列の要素に変換
    $array_binary = str_split($binary);
    $reverse = [];
    // 配列を反転させる
    for ($i = 0; $i < 7; $i++) {
        $reverse[] = array_pop($array_binary);
    }
    // 配列を2進数の文字列に戻す
    $reverse_asc = implode($reverse);
    // 2進数->ASCIIコード->文字に変換し、配列に格納
    $result[] = chr(bindec($reverse_asc));
}
// 配列を文字列に変換
$enc = implode($result);
var_dump($enc);


// 解読
$array = str_split($enc);
$result = [];
foreach ($array as $value) {
    $asc = ord($value);
    $binary = decbin($asc);
    $binary = str_pad($binary, 7, "0", STR_PAD_LEFT);
    $array_binary = str_split($binary);
    $reverse = [];
    for ($i = 0; $i < 7; $i++) {
        $reverse[] = array_pop($array_binary);
    }
    $reverse_asc = implode($reverse);
    $result[] = chr(bindec($reverse_asc));
}
$dec = implode($result);
var_dump($dec);
