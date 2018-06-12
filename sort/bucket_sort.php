<?php


// ソートする元の配列を用意しておく
$data = [3, 7, 8, 2, 9, 11, 1, 5];
// ソート後の正解は
// 1, 2, 3, 5, 7, 8, 9, 11
// になるはず！

// $sortedに答えが入る
$sorted = [];

// バケツソート
$max = 0;
$bucket = [];
foreach ($data as $value) {
    // dataの中身を、ラベルがついたバケツへ格納
    $bucket[$value]++;
    // のちにfor文で順番に取り出すために、dataの最大値を取得
    if ($max < $value) {
        $max = $value;
    }
}
// ラベルの値が小さいバケツから順番に取り出し、sortedに格納
for ($i = 0; $i <= $max; $i++){
    for ($j = 0, $len = $bucket[$i]; $j < $len; $j++) {
        array_push($sorted, $i);
    }
}

// 答えを出力する
var_dump($sorted);
