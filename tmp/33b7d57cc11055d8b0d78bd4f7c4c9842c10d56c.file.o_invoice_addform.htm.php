<?php /* Smarty version Smarty-3.0.8, created on 2014-08-31 08:44:30
         compiled from "E:\php/tpl\o_invoice_addform.htm" */ ?>
<?php /*%%SmartyHeaderCode:73765402e06e7a0ae7-52393211%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33b7d57cc11055d8b0d78bd4f7c4c9842c10d56c' => 
    array (
      0 => 'E:\\php/tpl\\o_invoice_addform.htm',
      1 => 1409474641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73765402e06e7a0ae7-52393211',
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
<link rel="stylesheet" type="text/css" href="js/form/style/validate.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/form/jquery.metadata.js"></script>
<script type="text/javascript" src="js/form/jquery.validate.js"></script>
<script type="text/javascript" src="js/form/i18n/messages_cn.js"></script>
<script type="text/javascript" src="js/common.js"></script>

<script language="javascript" type="text/javascript" src="js/My97DatePicker/WdatePicker.js"></script>
</head>

<body>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">进货</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'o_order_action','a'=>'index'),$_smarty_tpl);?>
">订单</a></li>
    <li>添加发票记录</li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>添加发票记录</span></div>

	    <form id="form1" action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'o_invoice_action','a'=>'addsave'),$_smarty_tpl);?>
" method=POST onsubmit="return $('#form1').validate().form();">
		    <ul class="forminfo">
		    <li><label>发票编号</label><input id="invoiceNo" name="invoiceNo" type="text" class="{required:true,maxlength:50} dfinput " /></li>
		    <li><label>金额</label><input id="money" name="money" type="text" class="{required:true,number:true,maxlength:50} dfinput " /></li>
		    <li><label>开票时间</label><input id="invoiceTime" name="invoiceTime" type="text" class="{required:true,dateISO:true} dfinput " readonly="readonly"  onClick="WdatePicker()" /></li>
		    <li><label>备注</label><textarea id="remark" name="remark" cols="" rows="" class="textinput" maxlength="300"></textarea></li>
		    <li><label>&nbsp;</label><input type="submit" id="btn_submit" class="btn" value="确认保存"/></li>
		    <input type=hidden id="orderId" name="orderId" value="<?php echo $_smarty_tpl->getVariable('order')->value['id'];?>
" />
		    </ul>
	    </form>

				    

    
    </div>

    

</body>

</html>
