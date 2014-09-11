<?php /* Smarty version Smarty-3.0.8, created on 2014-08-31 08:44:17
         compiled from "E:\php/tpl\o_left.htm" */ ?>
<?php /*%%SmartyHeaderCode:55065402e061033c22-57510543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35f74883a1f7c4128b928e53dec0220650aa12cf' => 
    array (
      0 => 'E:\\php/tpl\\o_left.htm',
      1 => 1409474641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55065402e061033c22-57510543',
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
	<div class="lefttop"><span></span>销货</div>
    
    <dl class="leftmenu">
        
    <dd>

    	<ul class="menuson">
    	<li class="active"><cite></cite><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'o_order_action','a'=>'index'),$_smarty_tpl);?>
" target="rightFrame">销售单</a><i></i></li>
        <li><cite></cite><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'o_pay_action','a'=>'index'),$_smarty_tpl);?>
" target="rightFrame">收款记录</a><i></i></li>
        <li><cite></cite><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'o_stock_action','a'=>'index'),$_smarty_tpl);?>
" target="rightFrame">出库记录</a><i></i></li>
        <li><cite></cite><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'o_invoice_action','a'=>'index'),$_smarty_tpl);?>
" target="rightFrame">开具发票记录</a><i></i></li>
        </ul>    
    </dd>
        
    
    </dl>
    
</body>
</html>
