<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/7/23
 * Time: 23:09
 */
class DB{
    static public function getDB(){
        $_mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if(mysqli_connect_errno()){
            echo '数据库连接错误:'.mysqli_connect_error();
            exit();
        }
        $_mysqli->set_charset('utf8');
        return $_mysqli;
    }
    static public function unDB(&$_result,&$_db){
        if(is_object($_result)){
            $_result ->free();
            $_result = null;
        }
        if(is_object($_db)){
            $_db -> close();
            $_db = null;
        }
    }
}