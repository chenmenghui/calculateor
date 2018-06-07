<?php
class calculator {
    public $memory;
    protected $scale;

    /**
     * calculator constructor.
     * @param string $init 初始值
     * @param int $scale 精确到第几位
     */
    public function __construct(string $init = '0', int $scale = 3) {
        $this->memory = $init;
        $scale = $scale - 1;
        bcscale($scale);
        $this->scale = $scale;
    }

    /**
     * 精确加
     * @param $num
     * @return $this
     */
    protected function math_add(string $num) {
        $this->memory = bcadd($this->memory, $num);
        return $this;
    }

    /**
     * 精确减
     * @param $num
     * @return $this
     */
    protected function math_minus(string $num) {
        $this->memory = bcsub($this->memory, $num);
        return $this;
    }

    /**
     * 精确乘
     * @param $num
     * @return $this
     */
    protected function math_multiply(string $num) {
        $this->memory = bcmul($this->memory, $num);
        return $this;
    }

    /**
     * 精确除
     * @param $num
     * @return $this
     */
    protected function math_divide(string $num) {
        $this->memory = bcdiv($this->memory, $num);
        return $this;
    }

    /**
     * 顺序加
     * @return $this
     */
    public function add(string ...$params) {
        foreach ($params as $param) {
            $this->math_add($param);
        }
        return $this;
    }

    /**
     * 顺序减
     * @return $this
     */
    public function minus(string ...$params) {
        foreach ($params as $param) {
            $this->math_minus($param);
        }
        return $this;
    }

    /**
     * 顺序乘
     * @return $this
     */
    public function multiply(string ...$params) {
        foreach ($params as $param) {
            $this->math_multiply($param);
        }
        return $this;
    }

    /**
     * 顺序除
     * @return $this
     */
    public function divide(string ...$params) {
        foreach ($params as $param) {
            $this->math_divide($param);
        }
        return $this;
    }

    /**
     * 等于
     * @return string
     */
    public function equal() :string {
        return $this->memory;
    }

    /**
     * 四舍五入
     * @return string
     */
    public function round() :string {
        return round($this->memory, $this->scale - 1);
    }

    /**
     * 魔术变量 化为字符串
     * @return string
     */
    public function __toString() {
        return $this->round();
    }

    /**
     * 清楚记忆
     * @return $this
     */
    public function clear() {
        $this->memory = 0;
        return $this;
    }
}