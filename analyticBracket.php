<?php
if (!class_exists('arithmeticExpression')) require 'arithmeticExpression.php';

/**
 * 主要针对多重括号，因不会二叉树，不得不出此下策
 * Class analyticBracket
 */
class analyticBracket extends arithmeticExpression {
    function __construct($scale = 3) {
        parent::__construct($scale);
        error_reporting(E_ALL & ~ E_NOTICE);
    }

    function expressionInput($input) {
        $this->check($input);
        $this->operation($input);
        return $this;
    }

    /**
     * 检查括号是否闭合等
     * @param $input
     */
    function check($input) {
        try {
            if (preg_match_all('/[^\d\+\-\*\/\{\}\[\]\(\)\ ]/', $input, $match)) {
                $match = implode('', $match[0]);
                throw new \Exception("{$input}存在不合法字符{$match}");
            }
            $inputArr = str_split($input);
            $big = 0;
            $middle = 0;
            $small = 0; // 大中小括号
            foreach ($inputArr as $key => $value) {
                if ($value === '(') {
                    $small++;
                } else if ($value === ')') {
                    $small--;
                    if ($small < 0) {
                        $str = substr($input, 0, $key + 1);
                        throw new \Exception("{$str}处括号不匹配");
                        break;
                    }
                } else if ($value === '[') {
                    $middle++;
                } else if ($value === ']') {
                    $middle--;
                    if ($small < 0) {
                        $str = substr($input, 0, $key + 1);
                        throw new \Exception("{$str}处括号不匹配");
                        break;
                    }
                } else if ($value === '{') {
                    $big++;
                } else if ($value === '}') {
                    $big--;
                    if ($small < 0) {
                        $str = substr($input, 0, $key + 1);
                        throw new \Exception("{$str}处括号不匹配");
                        break;
                    }
                }
            }
            if ($big > 0 || $middle > 0 || $small > 0) {
                throw new \Exception("{$input}有括号没有闭合");
            }
        } catch (Exception $exception) {
            die($exception);
        }
    }

    /**
     * 开始运算
     */
    function operation($input) {
        $inputArr = str_split(str_replace([' ', '{', '}', '[', ']'], ['', '(', ')', '(', ')'], $input));
        $bracket = 0;
        $block = 0;
        $section = [];
        foreach ($inputArr as $value) {
            if ($value === '(') {
                $bracket++;
                $block++;
                continue;
            } else if ($value === ')') {
                $bracket--;
                $block++;
                continue;
            }
            $section[$block][$bracket] .= $value;
        }
        $this->calc($section);
    }

    /**
     * @param $section
     * @return mixed　计算的结果
     *
     * 5*(3+2)+7*(1+2) =>
     */
    private function calc($section) {
        $max = 0;
        foreach ($section as $value) {
            $key = key($value);
            if ($max < $key) {
                $max = $key;
            }
        }
        if ($max > 0) {
            foreach ($section as $k => $value) {
                $key = key($value);
                if ($max == $key) {
                    $section[$k][$key - 1] = $this->input($value[$key]);
                    unset($section[$k][$key]);
                }
            }
        } else {
            $str = '';
            foreach ($section as $value) {
                $str .= $value[0];
            }
            $output = $this->input($str);
        }
        if ($output !== null) {
            return $output;
        } else {
            $this->calc($section);
        }
    }
}

// 测试
$test = new analyticBracket();
echo $test->expressionInput("5*(3+2)+7*(1+2)");