<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/7/24
 * Time: 9:16
 */
class Manage{
    private $_tpl;
    private $_admin_user;
    private $_admin_pass;
    private $_level;

    public function __construct(&$_tpl){
        $this->_tpl = $_tpl;
        $this->Action();
    }

    private function Action(){
        switch($_GET['action']){
            case 'list':
                $this->_tpl->assign('list',true);
                $this->_tpl->assign('title','管理员列表');
                $this->_tpl->assign('AllManage',$this->getManage());
                break;
            case 'add':
                if(isset($_POST['send'])){
                    $this->_admin_user = $_POST['admin_user'];
                    $this->_admin_pass = sha1($_POST['admin_pass']);
                    $this->_level = $_POST['level'];
                    $this->addManage()?Tool::alertLocation('恭喜你，新增管理员成功！','manage.php?action=list'):Tool::alertBack('对不起，新增失败！');
                }
                $this->_tpl->assign('add',true);
                $this->_tpl->assign('title','新增管理员');
                break;
            default:
                echo '非法操作';
        }
        $this->_tpl->display('manage.tpl');
    }

    private function getManage(){
        $_db = DB::getDB();
        $_sql = "SELECT
                                        id,
                                        admin_user,
                                        level,
                                        login_count,
                                        last_ip,
                                        last_time
                          FROM
                                        cms_manage
                          ORDER BY
                                        id ASC
                          LIMIT
                                        0,5";
        $_result = $_db->query($_sql);
        $_html = array();
        while(!!$_objects = $_result->fetch_object()){
            $_html[] = $_objects;
        }
        DB::unDB($_result,$_db);
        return $_html;
    }

    private function addManage(){
        $_db = DB::getDB();
        $_sql = "INSERT INTO
                                cms_manage(
                                              admin_user,
                                              admin_pass,
                                              level,
                                              reg_time
                                )
                                 VALUES(
                                              '$this->_admin_user',
                                              '$this->_admin_pass',
                                              '$this->_level',
                                              NOW()
                                 )";
        $_db ->query($_sql);
        $_affected_rows = $_db->affected_rows;
        DB::unDB($_result = null,$_db);
        return $_affected_rows;
    }
}