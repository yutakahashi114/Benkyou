<?php

/*
// 計測用
$count = 0;

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

    // 配列の要素数を取得
    $len = count($data);

    // 検索する配列の要素数と同じ長さの2次元配列を用意する
    $data_index = [];
    for ($i=0;$i < $len; $i++) {
        $data_index[$i] = [];
    }

    // 結果を格納する変数
    $result = 'not found';

    // 名字をハッシュ値（10進数）に変換する
    $hash_code = 'crc32';

    foreach ($data as $value) {
        $hash16 = hash($hash_code, $value[0]);
        $hash10 = hexdec($hash16);
        $rest = $hash10 % $len;
        // $data_index[名字を$lenで割った余り]に、名字と氏名の配列を格納する
        array_push($data_index[$rest], [$hash10, $value[1]]);
    }
    // 検索する名字の余りを求める
    $search_hash = hexdec(hash($hash_code, $search));
    $search_rest = $search_hash % $len;

    // 余りの中から名字を検索する
    foreach($data_index[$search_rest] as $value) {
        // $count++;
        if ($value[0] === $search_hash) {
            $result = $value[1];
            break;
        }        
    }

    // 結果を出力する
    var_dump($result);
/*
}
var_dump($count);
