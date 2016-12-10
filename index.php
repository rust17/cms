<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/30
 * Time: 6:54
 */
header('Content-Type:text/html;charset=utf-8');
include dirname(__FILE__) . '/init.inc.php';
global $_tpl;
$_tpl->assign('title','标头');
$_tpl->display('index.tpl');