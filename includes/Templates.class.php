<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/30
 * Time: 22:13
 */
class Templates{
    private $_vars = array();
    private $_config = array();
    public function __construct(){
        if(file_exists(TPL_DIR) || file_exists(TPL_C_DIR) || file_exists(CACHE)){
            $_sxe = simplexml_load_file(ROOT_PATH.'/config/profile.xml');
            $_taglib = $_sxe ->xpath('/root/taglib');
            foreach ($_taglib as $_tag){
                $this->_config["$_tag->name"] = "$_tag->value";
            }
        }else{
            exit('ERROR:模板文件目录或编译文件目录或缓存文件目录不存在');
        }
    }
    public function display($_file){
        $_tplFile = TPL_DIR.$_file;
        if(!file_exists($_tplFile)){
            exit('ERROR:模板文件不存在！');
        }
        $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
        $_cacheFile = CACHE.md5($_file).$_file.'.html';
        if(IS_CACHE){
            if(file_exists($_parFile) && file_exists($_tplFile)){
                if( filemtime($_parFile) >= filemtime($_tplFile) && filemtime($_cacheFile) >= filemtime($_parFile)){
                    include $_cacheFile;
                    return;
                }
            }
        }
        if(!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
            file_put_contents($_parFile, file_get_contents($_tplFile));
            require ROOT_PATH.'/includes/Parser.class.php';
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }
        include $_parFile;
        if(IS_CACHE){
            file_put_contents($_cacheFile,ob_get_contents());
            ob_end_clean();
            include $_cacheFile;
        }

    }
    public function assign($_var,$_value){
        if(isset($_var) && !empty($_var)){
            $this->_vars[$_var] = $_value;
        }else{
            exit('ERROR:请设置变量名！');
        }
    }
    public function create($_file){
        $_tplFile = TPL_DIR.$_file;
        if(!file_exists($_tplFile)){
            exit('ERROR:模板文件不存在！');
        }
        $_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
        if(!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)){
            file_put_contents($_parFile,file_get_contents($_tplFile));
            require_once ROOT_PATH.'/includes/Parser.class.php';
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }
        include $_parFile;
    }
}