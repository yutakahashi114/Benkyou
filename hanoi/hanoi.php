<?php


$hanoi = [ [ 1, 2, 3, 4, 5 ], [], [] ];
// $hanoi = [ [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ], [], [] ];

// ここで、ハノイの塔を解く
// $hanoiが$hanoi_resultと同じ感じになればOK!

/**
 * @param array   $hanoi  ハノイの塔
 * @param integer $height 塔の高さ
 * @param integer $now    塔の現在位置（0, 1, 2）
 * @param integer $move   塔を動かす方向（1, -1）
 */
function hanoi($hanoi, $height, $now, $move)
{
    if ($height === 1) {
        $next = ($now + $move + 3) % 3;
        array_unshift($hanoi[$next], array_shift($hanoi[$now]));
        return [$hanoi, $next];
    } else {
        $result = hanoi($hanoi, $height - 1, $now, -1 * $move);
        $hanoi = $result[0];
        $next = $result[1];

        array_unshift($hanoi[($now + $move + 3) % 3], array_shift($hanoi[$now]));

        $result = hanoi($hanoi, $height - 1, $next, -1 * $move);
        $hanoi = $result[0];
        $next = $result[1];
        
        return [$hanoi, $next];
    }
}

$result = hanoi($hanoi, count($hanoi[0]), 0, 1);
var_dump($result[0]);

$hanoi_result = [ [], [ 1, 2, 3, 4, 5 ], [] ];
// var_dump($hanoi_result);
