<?php /* Smarty version Smarty-3.0.8, created on 2014-08-25 16:29:03
         compiled from "G:\dev\APMServ5.2.6_me\www\htdocs/tpl\stat_2.htm" */ ?>
<?php /*%%SmartyHeaderCode:2761453fb644fddd699-59166580%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b8a8f5107fea6ce1eccaae5705b14b87f4cdbd0' => 
    array (
      0 => 'G:\\dev\\APMServ5.2.6_me\\www\\htdocs/tpl\\stat_2.htm',
      1 => 1408984100,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2761453fb644fddd699-59166580',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'G:\dev\APMServ5.2.6_me\www\htdocs\SpeedPHP\Drivers\Smarty\plugins\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		
		//提交确认删除表单
		$(".deletes").click(function(){
			var count = $("input[name='chk_list[]']:checked").length;
			if(count>0){
				if(confirm("确定删除选中?")){
					$('#form1').attr('action','<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'deleteselect'),$_smarty_tpl);?>
');
		  			$('#form1')[0].submit();
				}
			}else{
				alert("请勾选要删除的记录");
			}
		});
		
		//提交修改表单请求
		$(".updates").click(function(){
			var count = $("input[name='chk_list[]']:checked").length;
			if(count==1){
				$('#form1').attr('action','<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'updateform'),$_smarty_tpl);?>
');
		  		$('#form1')[0].submit();
			}else{
				alert("请选中唯一一条记录");
			}
		});

		$("#chk_btn").click(function(){
			$("input[name='chk_list[]']").attr('checked', $(this).attr('checked')); 
		});

});
</script>
</head>
<body>

	<div class="place">
	<span>位置：</span>
    <ul class="placeul">
    <li class="active"><a href="#">统计</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'stat2'),$_smarty_tpl);?>
">未到货明细表</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
    	 <ul class="toolbar">
        <!--a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'addform'),$_smarty_tpl);?>
"><li><span><img src="images/t01.png" /></span>添加</li></a-->
        <!--a href="#"><li class="updates"><span><img src="images/t02.png" /></span>修改</li></a-->
        <!--a href="#"><li class="deletes"><span><img src="images/t03.png" /></span>删除</li></a-->
        
        </ul>
    	<ul class="toolbar1">
        <!--li><span><img src="images/t05.png" /></span>设置</li-->
        <form id="form_search"  action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'index'),$_smarty_tpl);?>
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
        <th><input id="chk_btn" name="" type="checkbox" value=""/></th>
        <th>订货日期</th>
        <th>到货状态</th>
        <th>品名</th>
        <th>规格</th>
        <th>单位</th>
        <th>购入数量</th>
        <th>单价</th>
        <th>金额</th>
        <th>供应商</th>
        <th>效期</th>
        <th>隶属</th>
        </tr>
        </thead>
        <tbody  class="tbody">
	        <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('results')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
			    <tr>
			        <td><input name="chk_list[]" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
" /></td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['orderTime'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['receive_status'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['name'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['spec'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['unit'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['amount'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['price'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['money'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['unitName'];?>
</td>
			        <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['a']->value['validTime'],'%Y-%m-%d');?>
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
	        <li class="paginItem"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'index','page'=>$_smarty_tpl->getVariable('pager')->value['first_page']),$_smarty_tpl);?>
"><span class="pagepre"></span></a></li>
	        
	        <?php  $_smarty_tpl->tpl_vars['thepage'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pager')->value['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['thepage']->key => $_smarty_tpl->tpl_vars['thepage']->value){
?>
	        <?php if ($_smarty_tpl->tpl_vars['thepage']->value!=$_smarty_tpl->getVariable('pager')->value['current_page']){?>
	                <li class="paginItem"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'index','page'=>$_smarty_tpl->tpl_vars['thepage']->value),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['thepage']->value;?>
</a></li>
	        <?php }else{ ?>
	                <li class="paginItem current"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'index','page'=>$_smarty_tpl->tpl_vars['thepage']->value),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['thepage']->value;?>
</a></a></li>
	        <?php }?>
	        <?php }} ?>
	        <li class="paginItem"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'stat_action','a'=>'index','page'=>$_smarty_tpl->getVariable('pager')->value['last_page']),$_smarty_tpl);?>
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
