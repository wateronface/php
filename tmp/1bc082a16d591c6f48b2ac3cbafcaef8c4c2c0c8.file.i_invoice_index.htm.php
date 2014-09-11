<?php /* Smarty version Smarty-3.0.8, created on 2014-08-25 14:52:35
         compiled from "G:\dev\APMServ5.2.6_me\www\htdocs/tpl\i_invoice_index.htm" */ ?>
<?php /*%%SmartyHeaderCode:3061953fb4db3afa696-78714140%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bc082a16d591c6f48b2ac3cbafcaef8c4c2c0c8' => 
    array (
      0 => 'G:\\dev\\APMServ5.2.6_me\\www\\htdocs/tpl\\i_invoice_index.htm',
      1 => 1408978353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3061953fb4db3afa696-78714140',
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
    <li class="active"><a href="#">进货</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_invoice_action','a'=>'index'),$_smarty_tpl);?>
">发票登记记录</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
    	 <ul class="toolbar">
        <!--a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'product_action','a'=>'addform'),$_smarty_tpl);?>
"><li><span><img src="images/t01.png" /></span>添加</li></a-->
        <!--a href="#"><li class="updates"><span><img src="images/t02.png" /></span>修改</li></a-->
        <a href="#"><li class="deletes"><span><img src="images/t03.png" /></span>删除</li></a>
        
        </ul>
    	<ul class="toolbar1">
        <!--li><span><img src="images/t05.png" /></span>设置</li-->
        <form id="form_search"  action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_invoice_action','a'=>'index'),$_smarty_tpl);?>
" method="post">
	        <li style="padding-left:0px;padding-right:0px;" ><input name="search_key" type="text" class="dfinput short" value="<?php echo $_smarty_tpl->getVariable('search_key')->value;?>
" /></li>
	        <li class="searchs"><a href="#"><span><img src="images/t06.png" /></span>筛选</a></li>
        </form>
        </ul>
    </div>
    
    <form id="form1" action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_invoice_action','a'=>'deleteselect'),$_smarty_tpl);?>
" method="post">
    <table class="tablelist">
    	<thead>
    	<tr>
        <th><input id="chk_btn" name="" type="checkbox" value=""/></th>
        <th>发票编号</th>
        <th>发票金额</th>
        <th>订单编号</th>
        <th>所属</th>
        <th>货品</th>
        <th>供应商</th>
        <th>录入人</th>
        <th>录入时间</th>
        
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
			        
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['invoiceNo'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['money'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['orderNo'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['who'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['name'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['unitName'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['username'];?>
</td>
			        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['updateTime'];?>
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
	        <li class="paginItem"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_invoice_action','a'=>'index','page'=>$_smarty_tpl->getVariable('pager')->value['first_page']),$_smarty_tpl);?>
"><span class="pagepre"></span></a></li>
	        
	        <?php  $_smarty_tpl->tpl_vars['thepage'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pager')->value['all_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['thepage']->key => $_smarty_tpl->tpl_vars['thepage']->value){
?>
	        <?php if ($_smarty_tpl->tpl_vars['thepage']->value!=$_smarty_tpl->getVariable('pager')->value['current_page']){?>
	                <li class="paginItem"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_invoice_action','a'=>'index','page'=>$_smarty_tpl->tpl_vars['thepage']->value),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['thepage']->value;?>
</a></li>
	        <?php }else{ ?>
	                <li class="paginItem current"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_invoice_action','a'=>'index','page'=>$_smarty_tpl->tpl_vars['thepage']->value),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['thepage']->value;?>
</a></a></li>
	        <?php }?>
	        <?php }} ?>
	        <li class="paginItem"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_invoice_action','a'=>'index','page'=>$_smarty_tpl->getVariable('pager')->value['last_page']),$_smarty_tpl);?>
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
