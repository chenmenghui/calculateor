<?php
class calculator {
    public $memory;
    protected $scale;

    /**
     * calculator constructor.
     * @param int $scale 精确到第几位
     */
    public function __construct($scale = 3) {
        $this->memory = 0;
        $this->scale = $scale;
    }

    /**
     * 精确加
     * @param $num
     * @return $this
     */
    protected function math_add($num) {
        $this->memory = bcadd($this->memory, $num, $this->scale);
        return $this;
    }

    /**
     * 精确减
     * @param $num
     * @return $this
     */
    protected function math_minus($num) {
        $this->memory = bcsub($this->memory, $num, $this->scale);
        return $this;
    }

    /**
     * 精确乘
     * @param $num
     * @return $this
     */
    protected function math_multiply($num) {
        $this->memory = bcmul($this->memory, $num, $this->scale);
        return $this;
    }

    /**
     * 精确除
     * @param $num
     * @return $this
     */
    protected function math_divide($num) {
        $this->memory = bcdiv($this->memory, $num, $this->scale);
        return $this;
    }

    /**
     * 顺序加
     * @return $this
     */
    function add() {
        foreach (func_get_args() as $value) {
            $this->math_add($value);
        }
        return $this;
    }

    /**
     * 顺序减
     * @return $this
     */
    function minus() {
        foreach (func_get_args() as $value) {
            $this->math_minus($value);
        }
        return $this;
    }

    /**
     * 顺序乘
     * @return $this
     */
    function multiply() {
        foreach (func_get_args() as $value) {
            $this->math_multiply($value);
        }
        return $this;
    }

    /**
     * 顺序除
     * @return $this
     */
    function divide() {
        foreach (func_get_args() as $value) {
            $this->math_divide($value);
        }
        return $this;
    }

    /**
     * 等于
     * @return int
     */
    function equal() {
        return $this->memory;
    }

    /**
     * 魔术变量 化为字符串
     * @return int
     */
    function __toString() {
        return $this->equal();
    }

    /**
     * 清楚记忆
     * @return $this
     */
    function clear() {
        $this->memory = 0;
        return $this;
    }
}