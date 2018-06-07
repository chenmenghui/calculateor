<?php
/**
 * Created by PhpStorm.
 * User: 22740
 * Date: 2018/6/7
 * Time: 9:56
 */
require 'calculator.php';
$cal = new calculator();
echo $cal->add(2, 3, 4, 5)->divide(2)->minus(3)->multiply(5, 3);

