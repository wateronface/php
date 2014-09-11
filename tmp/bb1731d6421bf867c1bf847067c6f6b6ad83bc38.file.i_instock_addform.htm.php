<?php /* Smarty version Smarty-3.0.8, created on 2014-08-25 13:35:17
         compiled from "G:\dev\APMServ5.2.6_me\www\htdocs/tpl\i_instock_addform.htm" */ ?>
<?php /*%%SmartyHeaderCode:1780553fb3b95c335a2-32680580%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb1731d6421bf867c1bf847067c6f6b6ad83bc38' => 
    array (
      0 => 'G:\\dev\\APMServ5.2.6_me\\www\\htdocs/tpl\\i_instock_addform.htm',
      1 => 1408973673,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1780553fb3b95c335a2-32680580',
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
</head>

<body>
<script>
	
	$(function(){
		dataInput = $("#invoiceTime");
	    var str = getCurrentDate();
		$('#dateWidget').val(str);
		dataInput.val(str);
		
		
	});



</script>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">进货</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'index'),$_smarty_tpl);?>
">订单</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_instock_action','a'=>'addform'),$_smarty_tpl);?>
">添加入库记录</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>添加入库记录</span></div>

		<fieldset style="padding:20px;margin-bottom:20px;width:300;height:150;border:1px solid #CBCBCB" align="center"> 
		<legend style="margin-left:30px;padding:10px;border:1px solid #CBCBCB;background-color:#F0F5F7;text-align:left;font-family:arial;font-weight:bold"> 
		订单编号：<?php echo $_smarty_tpl->getVariable('order')->value['orderNo'];?>

		</legend> 
		<table width=100%<?php ?>>
			<tr>
				<td align=left width=33%<?php ?>>供应商：<?php echo $_smarty_tpl->getVariable('order')->value['unitName'];?>
</td>
				<td align=left width=33%<?php ?>>录入人：<?php echo $_smarty_tpl->getVariable('order')->value['username'];?>
</td>
				<td align=left width=33%<?php ?>>订单时间：<?php echo $_smarty_tpl->getVariable('order')->value['orderTime'];?>
</td>
			</tr>
			<tr>
				<td align=left width=33%<?php ?>>备注：<?php echo $_smarty_tpl->getVariable('order')->value['remark'];?>
</td>
				<td align=left width=33%<?php ?>>所属：<?php if ($_smarty_tpl->getVariable('order')->value['who']==1){?>森大<?php }else{ ?>碧海洋<?php }?></td>
				<td align=left width=33%<?php ?>>录入时间：<?php echo $_smarty_tpl->getVariable('order')->value['updateTime'];?>
</td>
			</tr>
		</table>
		</fieldset>



		<form id="form1" action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_instock_action','a'=>'saveform'),$_smarty_tpl);?>
" method="post">
			<input type=hidden id="orderId" name="orderId" value="<?php echo $_smarty_tpl->getVariable('order')->value['id'];?>
" />
		    <table class="tablelist">
		    	<thead>
		    	<tr>
		        <th>品名</th>
		        <th>单价</th>
		        <th>订单数量</th>
		        <th>已入库数量</th>
		        <th>未入库数量</th>
		        <th>入库数量(不能大于未入库数量)</th>
		        <th>效期(yyyy-mm-dd)</th>
		        </tr>
		        </thead>
		        <tbody  class="tbody">
			        <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('product_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
					    <tr>
					        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['name'];?>
</td>
					        <td style="padding-right:10px;"align="right"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['a']->value['price']);?>
</td>
					        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['amount'];?>
</td>
					        <td><?php if ($_smarty_tpl->tpl_vars['a']->value['amount_received']){?><?php echo $_smarty_tpl->tpl_vars['a']->value['amount_received'];?>
<?php }else{ ?>0<?php }?></td>
					        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['amount']-$_smarty_tpl->tpl_vars['a']->value['amount_received'];?>
</td>
					        <td><input type="text" name="amount[]" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['amount']-$_smarty_tpl->tpl_vars['a']->value['amount_received'];?>
" style="border:1px solid #000" /></td>
					        <td><input type="text" name="validTime[]" style="border:1px solid #000" /></td>
					        <input type="hidden" name="productId[]" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['productId'];?>
" />
				        </tr> 
			        <?php }} ?>
			    	
		        </tbody>
		    </table>
		    <div align=center style="margin-top:20px;"><label>&nbsp;</label><input type="submit" id="btn_submit" class="btn" value="确认保存"/></div>

	    </form>		    

    
    </div>


</body>

</html>
