<?php /* Smarty version Smarty-3.0.8, created on 2014-08-31 07:10:49
         compiled from "E:\php/tpl\i_order_addform.htm" */ ?>
<?php /*%%SmartyHeaderCode:112415402ca7944b292-94455463%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83cf7a31f2b24d52b6a8ad4260db2ae045ff6bab' => 
    array (
      0 => 'E:\\php/tpl\\i_order_addform.htm',
      1 => 1409467551,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112415402ca7944b292-94455463',
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
<link rel="stylesheet" type="text/css" href="js/form/style/validate.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/form/jquery.metadata.js"></script>
<script type="text/javascript" src="js/form/jquery.validate.js"></script>
<script type="text/javascript" src="js/form/i18n/messages_cn.js"></script>
        

<script language="javascript" type="text/javascript" src="js/My97DatePicker/WdatePicker.js"></script>

        
</head>

<body>
<script>
	var currentListType = 0;//0-货品列表 1-供应商列表
	var productArray=[],productArraySelected = [];
	var unitArray=[],unitArraySelected = [];

	var productDetail=[];

	 <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
	 	var product = new Object();
	 	product.id = <?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
;
	 	product.name = '<?php echo $_smarty_tpl->tpl_vars['a']->value['name'];?>
';
	    productArray.push(product);
    <?php }} ?>
	<?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('units')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
	 	var unit = new Object();
	 	unit.id = <?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
;
	 	unit.name = '<?php echo $_smarty_tpl->tpl_vars['a']->value['unitName'];?>
';
	    unitArray.push(unit);
    <?php }} ?>
	<?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productDetailList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
	 	var detail = new Object();
	 	detail.id = <?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
;
	 	detail.name = '<?php echo $_smarty_tpl->tpl_vars['a']->value['name'];?>
';
	 	detail.price = '<?php echo $_smarty_tpl->tpl_vars['a']->value['price'];?>
';
	 	detail.amount = '<?php echo $_smarty_tpl->tpl_vars['a']->value['amount'];?>
';
	    productDetail.push(detail);
    <?php }} ?>
	$(function(){
		//将productArray显示到右侧
		render_product_array();
		
		if('<?php echo $_smarty_tpl->getVariable('action')->value;?>
'=='update'){
			
			//如果是修改模式下,显示供应商名称
			unitId = '<?php echo $_smarty_tpl->getVariable('i_order')->value['unitId'];?>
';
			for(var i=0;i<unitArray.length;i++){
				if(unitArray[i].id==unitId){
					var obj = unitArray[i];
					var item = '<li id='+obj.id+' name="'+obj.name+'">'+obj.name+'</li>';
		   			 $('#unit').empty();
		    		$('#unit').append($(item));
				}
			}
			//如果是修改模式下,显示货品列表
			for(var i=0;i<productDetail.length;i++){
				var obj = productDetail[i];
				for(var j=0;j<productArray.length;j++){
					if(obj.id==productArray[j].id){
						productArray.splice(j,1);
						var product = new Object();
		 				product.id = obj.id;
		 				product.name = obj.name;
		   				productArraySelected.push(product);
						var item = '<li id='+obj.id+' name="'+obj.name+'"><input class="amount" type=text value="'+obj.price+'"> * <input class="amount" type=text value="'+obj.amount+'" > * '+obj.name+'<a href="#" onclick="removeOne(this)"><i>x</i></a></li>';
						$('.dfinput-select').append($(item));
					}
				}
			}
			render_product_array();
		}
		
		
		//提交表单
		$('#btn_submit').click(function(){
			var unitId = $($('#unit').children()).attr("id");
			//加入unitId
			$('#submit_unit').val(unitId);
			
			var lis = $('.dfinput-select').children();
			var detail="";
			for(var i=0;i<lis.length;i++){
				if(i>0){
					detail = detail+"@@@";
				}
				var productId = $(lis[i]).attr('id');
				var price = $($(lis[i]).children()).first().val();
				var amount = $($(lis[i]).children()).first().next().val();
				detail = detail+productId+"___"+price+"___"+amount;
			}
			$('#submit_detail').val(detail);
			$('#form1')[0].submit();
		});
		
	});
	function getCurrentDate(){
		var date=new Date;
		 var year=date.getFullYear(); 
		 var month=date.getMonth()+1;
		 month =(month<10 ? "0"+month:month); 
		 var day = date.getDate();
		 day =(day<10 ? "0"+day:day); 
	     return year+'-'+month+'-'+day;
	} 
	//显示货品列表
	function show_product_list(){
		$('#dateWidgetContainer').hide();
		$('#obj_filter').show();
		$('.obj_items').show();
		$("#list_title").html("货品列表(单击添加至订单)");
		render_product_array();
		currentListType = 0;
	}
	//显示供应商列表
	function show_unit_list(){
		$('#dateWidgetContainer').hide();
		$('#obj_filter').show();
		$("#list_title").html("供应商列表(单击添加至订单)");
		render_unit_array();
		currentListType = 1;
	}
	//点击弹出一个加入左侧
	function addOne(obj){
		if(currentListType == 0){
			for(var i=0;i<productArray.length;i++){
				if(obj.id==productArray[i].id){
					productArray.splice(i,1);
				}
			}
			var product = new Object();
		 	product.id = obj.id;
		 	product.name = obj.name;
		    productArraySelected.push(product);
			var item = '<li id='+obj.id+' name="'+obj.name+'"><input class="amount" type=text value="单价"> * <input class="amount" type=text value="数量" > * '+obj.name+'<a href="#" onclick="removeOne(this)"><i>x</i></a></li>';
			$('.dfinput-select').append($(item));
			render_product_array();
		}else{
			var item = '<li id='+obj.id+' name="'+obj.name+'">'+obj.name+'</li>';
		    $('#unit').empty();
		    $('#unit').append($(item));
		}

	}
	//释放一个到右侧
	function removeOne(obj){
		obj = $(obj).parent();
		
		var product = new Object();
	 	product.id = obj.attr('id')
	 	product.name = obj.attr('name');
	 	productArray.push(product);
		for(var i=0;i<productArraySelected.length;i++){
			if(obj.id==productArraySelected[i].id || productArray){
				productArraySelected.splice(i,1);
			}
		}
		obj.remove();
		render_product_array();
	}
	//初始化货品列表
	function render_product_array(){
		$('.obj_items').empty();
		for(var i=0;i<productArray.length;i++){
			$('.obj_items').append('<a href="javascript:void(0)" id="'+productArray[i].id+'" name="'+productArray[i].name+'" onclick=addOne(this)><li>'+productArray[i].name+'</li></a>');
		}
	}
	//初始化供应商列表
	function render_unit_array(){
		$('.obj_items').empty();
		for(var i=0;i<unitArray.length;i++){
			$('.obj_items').append('<a href="javascript:void(0)" id="'+unitArray[i].id+'" name="'+unitArray[i].name+'" onclick=addOne(this)><li>'+unitArray[i].name+'</li></a>');
		}
	}
	
	//筛选
	function filter(){
		var key = $('#filter_key').val();
		var lis = $('.obj_items').children();
		for(var i=0;i<lis.length;i++){
			if($(lis[i]).attr('name').indexOf(key)<0){
				$(lis[i]).hide();
			}else{
				$(lis[i]).show();
			}
		}
	}
</script>
	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">进货</a></li>
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'index'),$_smarty_tpl);?>
">订单</a></li>
    <li><?php if ($_smarty_tpl->getVariable('action')->value=="add"){?>添加<?php }else{ ?>修改<?php }?>订单</li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span><?php if ($_smarty_tpl->getVariable('action')->value=="add"){?>添加<?php }else{ ?>修改<?php }?>订单</span></div>

	    <form id="form1" action="<?php if ($_smarty_tpl->getVariable('action')->value=="add"){?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'addsave'),$_smarty_tpl);?>
<?php }else{ ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'updatesave'),$_smarty_tpl);?>
<?php }?>" method=POST onsubmit="return $('#form1').validate().form();">
		    <ul class="forminfo">
		    <input type=hidden name="id" value="<?php echo $_smarty_tpl->getVariable('i_order')->value['id'];?>
" />
		    <li><label>订单编号</label><input id="orderNo" name="orderNo"  value="<?php echo $_smarty_tpl->getVariable('i_order')->value['orderNo'];?>
" type="text" class="{required:true,maxlength:50} dfinput" maxlength="30" /></li>
		    <li><label>所属公司</label><cite><input id="who" name="who" type="radio" value="1" checked="checked" />森大&nbsp;&nbsp;&nbsp;&nbsp;<input name="who" type="radio" value="2" <?php if ($_smarty_tpl->getVariable('i_order')->value['who']==2){?>checked="checked"<?php }?> />碧海洋</cite></li>

		    <li ><label>货品列表<br>(单价*数量*品名)</label>
		    
		    <ul class="dfinput-select">
		    
		    </ul>
		    
		    &nbsp;&nbsp;<a href="#" onclick="show_product_list()"><em class="choose">...</em></a></li>
		    
		    <li><label>供应商</label><div id="unit" type="text" class="{required:true,maxlength:50} dfinput-single" ></div>&nbsp;&nbsp;<a href="#" onclick="show_unit_list()"><em class="choose">...</em></a></li>
		    <li><label>订单时间</label><input id="orderTime" name="orderTime" type="text" class="{required:true,dateISO:true} dfinput" readonly="readonly" onClick="WdatePicker()" value="<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('i_order')->value['orderTime'],'%Y-%m-%d');?>
" /></li>
		    <li><label>备注</label><textarea id="remark" name="remark" cols="" rows="" class="textinput" maxlength="300"><?php echo $_smarty_tpl->getVariable('i_order')->value['remark'];?>
</textarea></li>
		    <li><label>&nbsp;</label><input type="button" id="btn_submit" class="btn" value="确认保存"/></li>
		    <input type=hidden id="submit_unit" name="unitId" />
		    <input type=hidden id="submit_detail" name="detail" />
		    </ul>
	    </form>

				    

    
    </div>

    <div class="objectlist">
    	<div class="tiptop"><span id="list_title">货品列表(单击添加至订单)</span></div>
      <div class="objectlistcontent">

      <div id="obj_filter">	<input name="no" id="filter_key" type="text" class="dfinput" style="width:190px;" />
      <a href="#" onclick="filter()">
      <span class="filter">筛选</span></a></div>
        <ul class="obj_items"></ul>
    
    </div>
    

</body>

</html>
