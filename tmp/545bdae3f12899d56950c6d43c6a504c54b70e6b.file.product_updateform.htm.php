<?php /* Smarty version Smarty-3.0.8, created on 2014-08-23 11:44:07
         compiled from "G:\dev\APMServ5.2.6_me\www\htdocs/tpl\product_updateform.htm" */ ?>
<?php /*%%SmartyHeaderCode:216353f87e878392c7-36842289%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '545bdae3f12899d56950c6d43c6a504c54b70e6b' => 
    array (
      0 => 'G:\\dev\\APMServ5.2.6_me\\www\\htdocs/tpl\\product_updateform.htm',
      1 => 1408794245,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216353f87e878392c7-36842289',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">设置</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'index'),$_smarty_tpl);?>
">产品列表</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'addform'),$_smarty_tpl);?>
">添加产品</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    <div class="formtitle"><span>添加产品</span></div>
	    <form action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'saveform'),$_smarty_tpl);?>
" method=POST>
		    <ul class="forminfo">
		    <li><label>编号</label><input name="no" type="text" class="dfinput" value="<?php echo $_smarty_tpl->getVariable('results')->value['no'];?>
" /></li>
		    <li><label>名称</label><input name="name" type="text" class="dfinput"  value="<?php echo $_smarty_tpl->getVariable('results')->value['name'];?>
" /></li>
		    <li><label>规格</label><input name="spec" type="text" class="dfinput"  value="<?php echo $_smarty_tpl->getVariable('results')->value['spec'];?>
" /></li>
		    <li><label>单位</label><input name="unit" type="text" class="dfinput"  value="<?php echo $_smarty_tpl->getVariable('results')->value['unit'];?>
" /></li>
		    <li><label>初始库存</label><input name="init" type="text" class="dfinput"  value="<?php echo $_smarty_tpl->getVariable('results')->value['init'];?>
" /></li>
		    <li><label>备注</label><textarea name="remark" cols="" rows="" class="textinput" ><?php echo $_smarty_tpl->getVariable('results')->value['remark'];?>
</textarea><i>备注不能超过200个字符</i></li>
		    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
		    </ul>
	    </form>
    
    </div>


</body>

</html>
