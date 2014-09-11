<?php /* Smarty version Smarty-3.0.8, created on 2014-08-23 12:44:17
         compiled from "G:\dev\APMServ5.2.6_me\www\htdocs/tpl\ok.htm" */ ?>
<?php /*%%SmartyHeaderCode:3086953f88ca1855029-92492537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1dddb753860492b3dbf6274f166537d83d34b7b' => 
    array (
      0 => 'G:\\dev\\APMServ5.2.6_me\\www\\htdocs/tpl\\ok.htm',
      1 => 1408797851,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3086953f88ca1855029-92492537',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Refresh" content="2;URL=<?php echo $_smarty_tpl->getVariable('results')->value;?>
" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>

<script language="javascript">
	$(function(){
    $('.error').css({'position':'absolute','left':($(window).width()-490)/2});
	$(window).resize(function(){  
    $('.error').css({'position':'absolute','left':($(window).width()-490)/2});
    })  
});  
</script> 


</head>


<body style="background:#edf6fa;">

    
    <div class="ok">
    
    <p>2秒后自动跳转</p>
    <div class="reindex"><a href="<?php echo $_smarty_tpl->getVariable('results')->value;?>
" target="_self">继续</a></div>
    
    </div>


</body>

</html>
