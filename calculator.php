<?php
class calculator {
    public $memory;
    protected $scale;

    public function __construct($scale = 3) {
        error_reporting(E_ALL & ~ E_NOTICE);
        $this->memory = 0;
        $this->scale = $scale;
    }

    protected function math_add($num) {
        $this->memory = bcadd($this->memory, $num, $this->scale);
        return $this;
    }

    protected function math_minus($num) {
        $this->memory = bcsub($this->memory, $num, $this->scale);
        return $this;
    }


    protected function math_multiply($num) {
        $this->memory = bcmul($this->memory, $num, $this->scale);
        return $this;
    }

    protected function math_divide($num) {
        $this->memory = bcdiv($this->memory, $num, $this->scale);
        return $this;
    }

    function add() {
        foreach (func_get_args() as $value) {
            $this->math_add($value);
        }
        return $this;
    }
    
    function minus() {
        foreach (func_get_args() as $value) {
            $this->math_minus($value);
        }
        return $this;
    }

    function multiply() {
        foreach (func_get_args() as $value) {
            $this->math_multiply($value);
        }
        return $this;
    }

    function divide() {
        foreach (func_get_args() as $value) {
            $this->math_divide($value);
        }
        return $this;
    }

    function equal() {
        return $this->memory;
    }

    function __toString() {
        return $this->equal();
    }

    function clear() {
        $this->memory = 0;
        return $this;
    }
}