<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/7/24
 * Time: 21:12
 */
class Tool{
    static public function alertLocation($_info,$_url){
        echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
        exit();
    }
    static public function alertBack($_info){
        echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
    }
}