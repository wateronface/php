<?php /* Smarty version Smarty-3.0.8, created on 2014-08-26 00:40:28
         compiled from "E:\APMServ5.2.6\www\htdocs/tpl\top.htm" */ ?>
<?php /*%%SmartyHeaderCode:1820453fbd77cae0fe7-72296590%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cf6f0b4626dea326eb0364481ccd72c473f038d' => 
    array (
      0 => 'E:\\APMServ5.2.6\\www\\htdocs/tpl\\top.htm',
      1 => 1408979458,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1820453fbd77cae0fe7-72296590',
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
	//顶部导航切换
	$(".nav li a").click(function(){
		$(".nav li a.selected").removeClass("selected")
		$(this).addClass("selected");
	})	
})	
</script>


</head>

<body style="background:url(images/topbg.gif) repeat-x;">

    <div class="topleft">
    <a href="index.php" target="_parent"><img src="images/logo.png" title="系统首页" /></a>
    </div>
        
    <ul class="nav">
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'index'),$_smarty_tpl);?>
" target="rightFrame" class="selected" onclick="parent.leftFrame.location='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'left'),$_smarty_tpl);?>
'"><img src="images/icon01.png"  /><h2>统计</h2></a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'index'),$_smarty_tpl);?>
" target="rightFrame" onclick="parent.leftFrame.location='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'left'),$_smarty_tpl);?>
'"><img src="images/icon02.png" /><h2>进货</h2></a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'o_order_action','a'=>'index'),$_smarty_tpl);?>
"  target="rightFrame" onclick="parent.leftFrame.location='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'o_order_action','a'=>'left'),$_smarty_tpl);?>
'"><img src="images/icon03.png"  /><h2>销货</h2></a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'index'),$_smarty_tpl);?>
"  target="rightFrame" onclick="parent.leftFrame.location='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'left'),$_smarty_tpl);?>
'"><img src="images/icon06.png"  /><h2>设置</h2></a></li>
    </ul>
            
    <div class="topright">    
    <ul>
    
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'main','a'=>'logout'),$_smarty_tpl);?>
" target="_parent">退出</a></li>
    </ul>
     
    <div class="user">
    <span><?php echo $_SESSION['username'];?>
</span>
    
    </div>    
    
    </div>

</body>
</html>
