<?php /* Smarty version Smarty-3.0.8, created on 2014-08-24 01:15:15
         compiled from "G:\dev\APMServ5.2.6_me\www\htdocs/tpl\setup_left.htm" */ ?>
<?php /*%%SmartyHeaderCode:745053f93ca33afaa6-19973138%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db04d1b709f16bad674f6e817994cd42515d63a6' => 
    array (
      0 => 'G:\\dev\\APMServ5.2.6_me\\www\\htdocs/tpl\\setup_left.htm',
      1 => 1408841832,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '745053f93ca33afaa6-19973138',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})	
</script>


</head>

<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>设置</div>
    
    <dl class="leftmenu">
        
    <dd>
    	<ul class="menuson">
        <li class="active"><cite></cite><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'index'),$_smarty_tpl);?>
" target="rightFrame">货品</a><i></i></li>
        <li><cite></cite><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'unit_action','a'=>'index','type'=>'supplier'),$_smarty_tpl);?>
" target="rightFrame">供应商</a><i></i></li>
        <li><cite></cite><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'unit_action','a'=>'index','type'=>'client'),$_smarty_tpl);?>
" target="rightFrame">客户</a><i></i></li>
        <li><cite></cite><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'index','type'=>'user'),$_smarty_tpl);?>
" target="rightFrame">系统用户</a><i></i></li>
        </ul>    
    </dd>
        
    
    </dl>
    
</body>
</html>
