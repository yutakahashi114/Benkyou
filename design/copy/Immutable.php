<?php

class Immutable
{
    private $a;

    function __construct($setA){
        $this->a = $setA;
    }

    public function set($a) {
        $new = new Immutable($a);
        return $new;
    }
    public function get() {
        return $this->a;
    }
}

$str = new Immutable('ABC');

$str2 = $str->set('DEF');

var_dump($str->get());
var_dump($str2->get());
