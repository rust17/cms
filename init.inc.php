<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/30
 * Time: 6:54
 */
header('Content-Type:text/html;charset=utf-8');
define('ROOT_PATH',dirname( __FILE__));
require ROOT_PATH.'/config/profile.inc.php';
require 'cache.inc.php';
require ROOT_PATH.'/includes/DB.class.php';
require ROOT_PATH.'/includes/Tool.class.php';
require ROOT_PATH.'/includes/Templates.class.php';
$_tpl = new Templates();


