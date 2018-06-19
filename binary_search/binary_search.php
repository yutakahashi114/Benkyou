<?php

/*
// テスト用
$tests = [
    ['小笹', '佑京'],
    ['矢ヶ崎', '哲宏'],
    ['笠井', '美弦'],
    ['塚本','岳史'],
    ['近藤', '康平'],
    ['蓮見', '卓也'],
    ['所賀', '伸矢'],
    ['小柳津','裕真']
];

foreach ($tests as $test) {
    $search = $test[0];
*/

    $search = '小笹';

    // 検索する元の配列
    $data = [
        ['小笹', '佑京'],
        ['矢ヶ崎', '哲宏'],
        ['笠井', '美弦'],
        ['塚本','岳史'],
        ['近藤', '康平'],
        ['蓮見', '卓也'],
        ['所賀', '伸矢'],
        ['小柳津','裕真']
    ];

    // 名字をハッシュ値（10進数）に変換する
    $data_hash = [];

    $hash_code = 'md5';

    foreach ($data as $value) {
        $hash16 = hash($hash_code, $value[0]);
        $hash10 = [hexdec($hash16), $value[1]];
        array_push($data_hash, $hash10);
    }

    $search_hash = hexdec(hash($hash_code, $search));

    // バブルソート

    // 配列の要素数を取得
    $len = count($data_hash);
    // 隣り合う要素を比較する回数を取得
    $loop = $len - 1;

    for ($j = 0; $j < $len - 1; $j++) {
        // 最大を配列の右へ移動
        for ($i = 0; $i < $loop; $i++) {
            // 大きければ右へ移動
            if ($data_hash[$i][0] > $data_hash[$i + 1][0]) {
                $max = $data_hash[$i];
                $data_hash[$i] = $data_hash[$i + 1];
                $data_hash[$i + 1] = $max;
            }
        }
        // 最大の要素を右へ移動したので、次のループで比較する回数を1回減らす
        $loop--;
    }

    // 2分探索を実行
    $now = 0;
    $next = 0;
    $max = $len;
    $min = 0;
    $answer = '';

    for ($i = 0; $i < $len; $i++) {
        if ($data_hash[$now][0] == $search_hash) {
            // 一致していればanswerに代入してbreak
            $answer = $data_hash[$now][1];
            break;
        } elseif ($data_hash[$now][0] > $search_hash) {
            // 現在の値が大きければ、次は小さい方を探索
            $next = floor(($now + $min) / 2);
            $max = $now;
        } else {
            // 現在の値が小さければ、次は大きい方を探索
            $next = floor(($now + $max) / 2);
            $min = $now;
        }
        // 次に探索する値をnowに代入
        $now = $next;
        if ($min == $now) {
            // 次の値をすでに探していればbreak
            $answer = 'not found';
            break;
        }
    }
    // 答えを出力する
    var_dump($answer);
// }
