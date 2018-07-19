<?php

require_once  __DIR__.'/Collection.php';
require_once __DIR__.'/MyIterator.php';

class DTUMember implements Collection {
    private $nameList = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    ];
    // イテレータを生成
    public function getIterator() {
        return new MyIterator($this->nameList);
    }
    // 全件取得
    public function getAllMember() {
        $iterator = new MyIterator($this->nameList);
        $result = '';
        while ($iterator->hasNext() == true) {
            $name = $iterator->next();
            $result .= "$name\n";
        }
        return $result;
    }
}

$DTUMember = new DTUMember;
$iterator = $DTUMember->getIterator();
var_dump($iterator->hasNext());
var_dump($iterator->next());
var_dump($iterator->next());
var_dump($DTUMember->getAllMember());
