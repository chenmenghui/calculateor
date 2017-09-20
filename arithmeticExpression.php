<?php
if (!class_exists('calculator')) require './calculator.php';

/**
 * Class arithmeticExpression 算数表达式转换
 */
class arithmeticExpression extends calculator {
    public $param;

    /**
     * 输入
     * @param $param　输入的表达式
     * @return mixed　计算的结果
     */
    function input($param) {
        $this->param = $param;
        $this->sortMultiply();
        $this->sortDivide();
        $this->sortAdd();
        $this->sortMinus();
        return $this->param;
    }

    /**
     * 计算乘法
     * @return $this
     */
    private function sortMultiply() {
        $times = substr_count($this->param, '*');
        for ($i = 0; $i < $times; $i++) {
            $this->param = preg_replace_callback('/(\d+(\.\d+)?)\*(\d+(\.\d+)?)/', function ($num) {
                $result = $this->clear()->math_add($num[1])->math_multiply($num[3]);
                return $result;
            }, $this->param, 1);
        }
        return $this;
    }

    /**
     * 计算除法
     * @return $this
     */
    private function sortDivide() {
        $times = substr_count($this->param, '/');
        for ($i = 0; $i < $times; $i++) {
            $this->param = preg_replace_callback('/(\d+(\.\d+)?)\/(\d+(\.\d+)?)/', function ($num) {
                $result = $this->clear()->math_add($num[1])->math_divide($num[3]);
                return $result;
            }, $this->param, 1);
        }
        return $this;
    }

    /**
     * 计算加法
     * @return $this
     */
    private function sortAdd() {
        $times = substr_count($this->param, '+');
        for ($i = 0; $i < $times; $i++) {
            $this->param = preg_replace_callback('/(\d+(\.\d+)?)\+(\d+(\.\d+)?)/', function ($num) {
                $result = $this->clear()->math_add($num[1])->math_add($num[3]);
                return $result;
            }, $this->param, 1);
        }
        return $this;
    }

    /**
     * 计算减法
     * @return $this
     */
    private function sortMinus() {
        $times = substr_count($this->param, '-');
        for ($i = 0; $i < $times; $i++) {
            $this->param = preg_replace_callback('/(\d+(\.\d+)?)\-(\d+(\.\d+)?)/', function ($num) {
                $result = $this->clear()->math_add($num[1])->math_minus($num[3]);
                return $result;
            }, $this->param, 1);
        }
        return $this;
    }
}
