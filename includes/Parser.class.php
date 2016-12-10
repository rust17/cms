<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/30
 * Time: 22:15
 */
class Parser{
    private $_tpl;
    public function __construct($_tplFile){
        if(!$this->_tpl = file_get_contents($_tplFile)){
            exit('ERROR:读取模板文件错误！');
        }
    }
    private function parVar(){
        $_patten = '/\{\$([\w]+)\}/';
        if(preg_match($_patten,$this->_tpl)){
            $this->_tpl = preg_replace($_patten,"<?php echo \$this->_vars['$1'];?>",$this->_tpl);
        }
    }
   private function parIf(){
       $_pattenIf = '/\{if\s+\$([\w]+)\}/';
       $_pattenEndif = '/\{\/if\}/';
       $_pattenElse = '/\{else\}/';
       if(preg_match($_pattenIf,$this->_tpl)){
           if(preg_match($_pattenEndif,$this->_tpl)){
               $this->_tpl = preg_replace($_pattenIf,"<?php if(\$this->_vars['$1']){ ?>",$this->_tpl);
               $this->_tpl = preg_replace($_pattenEndif,"<?php } ?>",$this->_tpl);
               if(preg_match($_pattenElse,$this->_tpl)){
                   $this->_tpl = preg_replace($_pattenElse,"<?php }else{ ?>",$this->_tpl);
               }
           }else{
               exit('ERROR:if语句没有闭合');
           }
       }
   }
    private function configVar(){
        $_patten = '/<!--{([\w]+)}-->/';
        if(preg_match($_patten,$this->_tpl)){
            $this->_tpl = preg_replace($_patten,"<?php echo \$this->_config['\$1']?>",$this->_tpl);
        }
    }
    private function parForeach(){
        $_patten = '/\{@([\w]+)([\w\-\>]*)\}/';
        $_pattenFirstForeach = '/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
        $_pattenEndForeach = '/\{\/foreach\}/';
        if(preg_match($_pattenFirstForeach,$this->_tpl)){
            if(preg_match($_pattenEndForeach,$this->_tpl)) {
                $this->_tpl = preg_replace($_pattenFirstForeach, "<?php foreach (\$this->_vars['$1'] as \$$2=>\$$3){ ?>", $this->_tpl);
                $this->_tpl = preg_replace($_pattenEndForeach,"<?php } ?>",$this->_tpl);
                if(preg_match($_patten,$this->_tpl)){
                    $this->_tpl = preg_replace($_patten, "<?php echo \$$1$2 ?>", $this->_tpl);
                }
            }
            else{
                exit('ERROR:foreach语句没有闭合');
            }
        }
    }
    private function parInclude(){
        $_pattenInclude = '/\{include\s+\"([\w\.]+)\"\}/';
        if(preg_match($_pattenInclude,$this->_tpl,$_file)){
            if(empty($_file[1] || !file_exists($_file[1]))){
                exit('ERROR:包含文件有误');
            }
            $this->_tpl = preg_replace($_pattenInclude,"<?php include '$1';?>",$this->_tpl);
        }
    }
    private function parCommon(){
        $_patten = '/\{#\}(.*)\{#\}/';
        if(preg_match($_patten,$this->_tpl)){
            $this->_tpl = preg_replace($_patten,"/* \$1 */",$this->_tpl);
        }
    }
    public function compile($_parFile){
        $this->parVar();
        $this->parIf();
        $this->parForeach();
        $this->parInclude();
        $this->parCommon();
        $this->configVar();
        if(!file_put_contents($_parFile,$this->_tpl)){
            exit('ERROR:编译文件生成失败');
        }
    }
}