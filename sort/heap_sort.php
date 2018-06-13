<?php


// ソートする元の配列を用意しておく
$data = [3, 7, 8, 2, 9, 11, 1, 5];
// ソート後の正解は
// 1, 2, 3, 5, 7, 8, 9, 11
// になるはず！

// $sortedに答えが入る
$sorted = [];

// 配列の要素数を取得
$len = count($data);
$n = $len;

for ($j = 0; $j < $n; $j++) {
    // 比較回数
    $compare = floor($len/2);
    for ($i = $compare; $i > 0; $i--) {
        if (!(($i === $compare) && ($len%2 === 0))) {
            if ($data[$i - 1] > $data[$i * 2]) {
                $max = $data[$i - 1];
                $data[$i - 1] = $data[$i * 2];
                $data[$i * 2] = $max;
            }
        }
        if ($data[$i - 1] > $data[$i * 2 - 1]) {
            $max = $data[$i - 1];
            $data[$i - 1] = $data[$i * 2 - 1];
            $data[$i * 2 - 1] = $max;
        }
    }
    // sortedの末尾に挿入
    array_push($sorted, $data[0]);
    // 挿入した要素を元の配列から消去
    array_shift($data);
    $len--;
}

// 答えを出力する
var_dump($sorted);
