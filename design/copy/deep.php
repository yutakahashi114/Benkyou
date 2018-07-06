<?php

class Deep
{
    private $a;
    private $b;
    private $c;

    function __construct($a, $b, $c1, $c2){
        $this->a = $a;
        $this->b = $b;
        $this->c = new C($c1, $c2);
    }

    public function setA($a) {
        // 自身をクローン
        $new = clone $this;
        // 持っているインスタンスをクローンし、代入
        $new->c = clone $this->c;
        // 特定の値だけ書き換える
        $new->a = $a;
        // 結果をリターン
        return $new;
    }
    public function setB($b) {
        $new = clone $this;
        $new->c = clone $this->c;
        $new->b = $b;
        return $new;
    }
    public function setC($c1, $c2) {
        $new = clone $this;
        $new->c = clone $this->c;
        $new->c->c1 = $c1;
        $new->c->c2 = $c2;
        return $new;
    }

    public function getA() {
        return $this->a;
    }
    public function getB() {
        return $this->b;
    }
    public function getC() {
        return [$this->c->c1, $this->c->c2];
    }
    public function getAll() {
        return $array = [$this->getA(), $this->getB(), $this->getC()];
    }
}

class C
{
    public $c1;
    public $c2;

    function __construct($c1, $c2){
        $this->c1 = $c1;
        $this->c2 = $c2;
    }
}

$test = new Deep(1, 10, 100, 1000);

$testA = $test->setA(5);
$testB = $test->setB(50);
$testC = $test->setC(500, 5000);

var_dump($test->getAll());
var_dump($testA->getAll());
var_dump($testB->getAll());
var_dump($testC->getAll());
