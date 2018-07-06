<?php


$hanoi = [ [ 1, 2, 3, 4, 5,6 ], [], [] ];

// ここで、ハノイの塔を解く
// $hanoiが$hanoi_resultと同じ感じになればOK!

/**
 * 
 * @param array $hanoi ハノイの塔
 * @param integer $height 塔の高さ
 * @param integer $now 今の塔の位置（0, 1, 2）
 * @param integer $move 塔を動かす方向（1, -1）
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

$result = hanoi($hanoi, count($hanoi[0]), 0, 2);
var_dump($result[0]);







// $now = 2;

// var_dump(hanoi($hanoi, $now));

// function hanoi($hanoi, $now) {
//     $one = ($now + 1) % 3;
//     $two = ($now + 2) % 3;

//     if (count($hanoi[0]) === 0) {
//         if ((count($hanoi[1]) === 0) || (count($hanoi[2]) === 0)) {
//             return $hanoi;
//         }
//     }
//     if (count($hanoi[$now]) > 1) {
//         if ($hanoi[$now][0] === 1) {
//             if (count($hanoi[$one]) === 0) {
//                 array_unshift($hanoi[$two], arrayshift($hanoi[$one]));            
//                 $move = $two;
//             } elseif (count($hanoi[$two]) === 0) {
//                 array_unshift($hanoi[$one], array_shift($hanoi[$two]));            
//                 $move = $one;
//             } elseif ($hanoi[$one][0] > $hanoi[$two][0]) {
//                 array_unshift($hanoi[$one], array_shift($hanoi[$two]));
//                 $move = $one;
//             } else {
//                 array_unshift($hanoi[$two], array_shift($hanoi[$one]));
//                 $move = $two;
//             }
//         } else {
//             if (count($hanoi[$one]) === 0) {
//                 array_unshift($hanoi[$now], array_shift($hanoi[$two]));
//                 $move = $now;                
//             } elseif ($hanoi[$one][0] === 1) {
//                 array_unshift($hanoi[$two], array_shift($hanoi[$one]));
//                 $move = $two;
//             } else {
//                 array_unshift($hanoi[$now], array_shift($hanoi[$two]));
//                 $move = $now;
//             }
//         }
//     } else {
//         if (count($hanoi[$one]) === 0) {
//             array_unshift($hanoi[$now], array_shift($hanoi[$two]));
//             $move = $now;                
//         } elseif ($hanoi[$one][0] === 1) {
//             array_unshift($hanoi[$two], array_shift($hanoi[$one]));
//             $move = $two;
//         } else {
//             array_unshift($hanoi[$now], array_shift($hanoi[$two]));
//             $move = $now;
//         }
//     }    
//     return hanoi($hanoi, $move);
// }



$hanoi_result = [ [], [ 1, 2, 3, 4, 5 ], [] ];
// var_dump($hanoi_result);
