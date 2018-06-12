<?php


// ソートする元の配列を用意しておく
$data = [3, 7, 8, 2, 9, 11, 1, 5];
// ソート後の正解は
// 1, 2, 3, 5, 7, 8, 9, 11
// になるはず！

// $sortedに答えが入る
$sorted = [];

// セレクトソート
// dataの最小値を(要素数-1)回検索する。
for ($i = 0, $len = count($data) - 1; $i < $len; $i++){
    $min = 100;
    foreach ($data as $value) {
        // dataの最小値を取得
        if ($min > $value) {
            $min = $value;
        }
    }
    // sortedの末尾に挿入
    array_push($sorted, $min);
    // 挿入した要素を元の配列から消去
    $data = array_diff($data, array($min));
    $data = array_values($data);
}
// 残りの要素を挿入
array_push($sorted, $data[0]);

// 答えを出力する
var_dump($sorted);
