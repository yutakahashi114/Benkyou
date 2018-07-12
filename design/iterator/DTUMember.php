<?php

require_once  __DIR__.'/Collection.php';
require_once __DIR__.'/MyIterator.php';

class DTUMember implements Collection {
    public $iterator;
    private $nameList = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    ];
    // イテレータを生成
    public function getIterator() {
        $this->iterator = new MyIterator($this->nameList);
    }
    // 全件取得
    public function getAllMember() {
        $result = '';
        // イテレータを生成していれば全件取得する
        if (isset($this->iterator) === true) {
            // 配列の長さ+1だけ回す
            $len = count($this->nameList) + 1;
            for ($i = 0; $i < $len; $i++) {
                // 次がなければresultにfinishを追加
                if ($this->iterator->hasNext() === false) {
                    $result .= "finish";
                    return $result;
                }
                // 次があればresultに名前を追加
                $name = $this->iterator->next();
                $result .= "$name\n";
            }
        // イテレータを生成していなければmessageを返す
        } else {
            return $result = "no iterator\n";
        }
    }
}

$DTUMember = new DTUMember;
$DTUMember->getIterator();
var_dump($DTUMember->iterator->hasNext());
var_dump($DTUMember->iterator->next());
var_dump($DTUMember->iterator->next());
var_dump($DTUMember->getAllMember());
var_dump($DTUMember->iterator->hasNext());
var_dump($DTUMember->iterator->next());
