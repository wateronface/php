<?php /* Smarty version Smarty-3.0.8, created on 2014-08-25 08:52:15
         compiled from "E:\APMServ5.2.6\www\htdocs/tpl\i_order_payform.htm" */ ?>
<?php /*%%SmartyHeaderCode:916653faf93f2863b8-13662687%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffefde166fccf10c7d972e3337b2b0ff051124b2' => 
    array (
      0 => 'E:\\APMServ5.2.6\\www\\htdocs/tpl\\i_order_payform.htm',
      1 => 1408956730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '916653faf93f2863b8-13662687',
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
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script>var dataInput;</script>
        <script type="text/javascript" src="./js/datepicker.js"></script>
        <link href="./css/datepicker.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script>
	
	$(function(){
		dataInput = $("#payTime");
	    var str = getCurrentDate();
		$('#dateWidget').val(str);
		dataInput.val(str);
		
		//提交表单
		$('#btn_submit').click(function(){
			var unitId = $($('#unit').children()).attr("id");
			
			$('#submit_detail').val(detail);
			$('#form1')[0].submit();
		});
		
	});



</script>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">进货</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'index'),$_smarty_tpl);?>
">订单</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'addform'),$_smarty_tpl);?>
">添加订单</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>添加订单</span></div>

	    <form id="form1" action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'saveform'),$_smarty_tpl);?>
" method=POST>
		    <ul class="forminfo">
		    <li><label>金额</label><input id="money" name="money" type="text" class="dfinput" /></li>
		    <li><label>打款时间</label><input id="payTime" name="payTime" type="text" class="dfinput" readonly="readonly" /></li>
		    <li><label>备注</label><textarea id="remark" name="remark" cols="" rows="" class="textinput" maxlength="300"></textarea></li>
		    <li><label>&nbsp;</label><input type="button" id="btn_submit" class="btn" value="确认保存"/></li>
		    <input type=hidden id="orderId" name="orderId" value="<?php echo $_smarty_tpl->getVariable('order')->value['id'];?>
" />
		    </ul>
	    </form>

				    

    
    </div>

    <div class="objectlist">
    	<div class="tiptop"><span id="list_title">日期选择</span></div>
      <div class="objectlistcontent">
      
      	<div id="dateWidgetContainer"><input id="dateWidget" style="display:none" type="text" class="w8em format-y-m-d divider-dash highlight-days-12 no-fade" maxlength="10" /></div>

        <ul class="obj_items"></ul>
    
    </div>
    

</body>

</html>
