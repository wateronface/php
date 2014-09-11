<?php /* Smarty version Smarty-3.0.8, created on 2014-08-31 07:24:13
         compiled from "E:\php/tpl\stat_10.htm" */ ?>
<?php /*%%SmartyHeaderCode:324765402cd9d0fd270-58065456%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6ba2bae435a1ed5318d3bb5cca4f3ec9f395ebb' => 
    array (
      0 => 'E:\\php/tpl\\stat_10.htm',
      1 => 1409468934,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '324765402cd9d0fd270-58065456',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'E:\php\SpeedPHP\Drivers\Smarty\plugins\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery.knob.js"></script>


</head>
<body>

	<div class="place">
	<span>位置：</span>
    <ul class="placeul">
    <li class="active"><a href="#">统计</a></li>
    <li>应收款明细表</li>
    </ul>
    </div>
    
    <div class="tools">
    	 <ul class="toolbar">
        <!--a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'addform'),$_smarty_tpl);?>
"><li><span><img src="images/t01.png" /></span>添加</li></a-->
        <!--a href="#"><li class="updates"><span><img src="images/t02.png" /></span>修改</li></a-->
        <!--a href="#"><li class="deletes"><span><img src="images/t03.png" /></span>删除</li></a-->
        
        </ul>
    	<ul class="toolbar1">
        <!--li><span><img src="images/t05.png" /></span>设置</li-->
        <form id="form_search"  action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'stat10'),$_smarty_tpl);?>
" method="post">
	        <li style="padding-left:0px;padding-right:0px;" ><input name="search_key" type="text" class="dfinput short" value="<?php echo $_smarty_tpl->getVariable('search_key')->value;?>
" /></li>
	        <li class="searchs"><a href="#"><span><img src="images/t06.png" /></span>筛选</a></li>
        </form>
        </ul>
    </div>
    
    <form id="form1" action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'deleteselect'),$_smarty_tpl);?>
" method="post">
   
    <table class="tablelist">
    	<thead>
    	<tr>
        <th>订货日期</th>
		<th>订单编号</th>
        <th>种类</th>
        <th>货品明细</th>
        <th>含税金额（进）</th>
		<th>已支付金额</th>
		<th>未支付金额</th>
		<th>购入单位（供应商）</th>
        <th>所属单位</th>
        </tr>
        </thead>
        <tbody  class="tbody">
	        <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('results')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
			    <tr title="<?php echo $_smarty_tpl->tpl_vars['a']->value['remark'];?>
">
			        <td align=center><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['a']->value['orderTime'],'%Y-%m-%d');?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['orderNo'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['productCount'];?>
</td>
			        <td style="text-indent:0px;padding-left:10px;line-height:12px;font-size:12px;"><?php echo $_smarty_tpl->tpl_vars['a']->value['productDetail'];?>
</td>
			        <td style="padding-right:10px;"align="right"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['a']->value['money_all']);?>
</td>
					<td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['a']->value['money_payed']);?>
</td>
					<td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['a']->value['money_not_payed']);?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['a']->value['unitName'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['who'];?>
</td>
		        </tr> 
	        <?php }} ?>
        </tbody>
    </table>
	</form>
	
    
   	<?php if ($_smarty_tpl->getVariable('pager')->value){?>
    <div class="pagin">
    	<div class="message">共<i class="blue"><?php echo $_smarty_tpl->getVariable('pager')->value['total_count'];?>
</i>条记录，当前第&nbsp;<i class="blue"><?php echo $_smarty_tpl->getVariable('pager')->value['current_page'];?>
&nbsp;</i>页</div>
        <ul class="paginList">
	        <li class="paginItem"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'index','page'=>$_smarty_tpl->getVariable('pager')->value['first_page']),$_smarty_tpl);?>
"><span class="pagepre"></span></a></li>
	        
	        <?php  $_smarty_tpl->tpl_vars['thepage'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pager')->value['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['thepage']->key => $_smarty_tpl->tpl_vars['thepage']->value){
?>
	        <?php if ($_smarty_tpl->tpl_vars['thepage']->value!=$_smarty_tpl->getVariable('pager')->value['current_page']){?>
	                <li class="paginItem"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'index','page'=>$_smarty_tpl->tpl_vars['thepage']->value),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['thepage']->value;?>
</a></li>
	        <?php }else{ ?>
	                <li class="paginItem current"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'index','page'=>$_smarty_tpl->tpl_vars['thepage']->value),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['thepage']->value;?>
</a></a></li>
	        <?php }?>
	        <?php }} ?>
	        <li class="paginItem"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'index','page'=>$_smarty_tpl->getVariable('pager')->value['last_page']),$_smarty_tpl);?>
"><span class="pagenxt"></span></a></li>
        </ul>
    </div>
    <?php }?>
    
    
    </div>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');

	</script>

</body>

</html>
