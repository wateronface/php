<?php /* Smarty version Smarty-3.0.8, created on 2014-08-23 12:38:20
         compiled from "G:\dev\APMServ5.2.6_me\www\htdocs/tpl\o_left.htm" */ ?>
<?php /*%%SmartyHeaderCode:2685853f88b3cea1921-61136268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fb0fe373dfdd97cbe787e22f5e5be168cfcd988' => 
    array (
      0 => 'G:\\dev\\APMServ5.2.6_me\\www\\htdocs/tpl\\o_left.htm',
      1 => 1408625622,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2685853f88b3cea1921-61136268',
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
    	<li class="active"><cite></cite><a href="o_order_list.php" target="rightFrame">销售单</a><i></i></li>
        <li><cite></cite><a href="o_pay_list.php" target="rightFrame">回款记录</a><i></i></li>
        <li><cite></cite><a href="o_stock_list.php" target="rightFrame">出库记录</a><i></i></li>
        <li><cite></cite><a href="o_invoice_list.php" target="rightFrame">开具发票记录</a><i></i></li>
        </ul>    
    </dd>
        
    
    </dl>
    
</body>
</html>
