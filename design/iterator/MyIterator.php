<?php

class MyIterator {

    private $array = [];
    private $now = 0;

    function __construct($array) {
        $this->array = $array;
    }

    // 次の値を持っているか判定
    public function hasNext() {
        if (isset($this->array[$this->now])) {
            // 持っていればtrueを返す
            return true;
        }
        // 持っていなければfalseを返す
        return false;
    }

    // 次の値を持っていればそれを返す
    public function next() {
        if ($this->hasNext() === true) {
            $next = $this->array[$this->now];
            $this->now++;
            return $next;
        } else {
            return "no next";
        }
    }
}
