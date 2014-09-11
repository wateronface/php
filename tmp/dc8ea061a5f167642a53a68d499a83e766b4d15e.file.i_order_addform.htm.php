<?php /* Smarty version Smarty-3.0.8, created on 2014-08-25 08:13:54
         compiled from "E:\APMServ5.2.6\www\htdocs/tpl\i_order_addform.htm" */ ?>
<?php /*%%SmartyHeaderCode:358553faf042db4c49-23266897%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc8ea061a5f167642a53a68d499a83e766b4d15e' => 
    array (
      0 => 'E:\\APMServ5.2.6\\www\\htdocs/tpl\\i_order_addform.htm',
      1 => 1408953752,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '358553faf042db4c49-23266897',
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
<script>var dataInput;</script>
        <script type="text/javascript" src="./js/datepicker.js"></script>
        <link href="./css/datepicker.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script>
	var currentListType = 0;//0-货品列表 1-供应商列表
	var productArray=[],productArraySelected = [];
	var unitArray=[],unitArraySelected = [];

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
	$(function(){
		dataInput = $("#orderTime");
	    var str = getCurrentDate();
		$('#dateWidget').val(str);
		dataInput.val(str);
		//将productArray显示到右侧
		render_product_array();
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
	
	function show_product_list(){
		$('#dateWidgetContainer').hide();
		$('#obj_filter').show();
		$('.obj_items').show();
		$("#list_title").html("货品列表(单击添加至订单)");
		render_product_array();
		currentListType = 0;
	}
	function show_unit_list(){
		$('#dateWidgetContainer').hide();
		$('#obj_filter').show();
		$("#list_title").html("供应商列表(单击添加至订单)");
		render_unit_array();
		currentListType = 1;
	}
	function show_date_list(){
		$('#obj_filter').hide();
		$("#list_title").html("日期选择");
		$('.obj_items').hide();
		$('#dateWidgetContainer').show();
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
	function render_product_array(){
		$('.obj_items').empty();
		for(var i=0;i<productArray.length;i++){
			$('.obj_items').append('<a href="javascript:void(0)" id="'+productArray[i].id+'" name="'+productArray[i].name+'" onclick=addOne(this)><li>'+productArray[i].name+'</li></a>');
		}
	}
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
    <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'addform'),$_smarty_tpl);?>
">添加订单</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>添加订单</span></div>

	    <form id="form1" action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'i_order_action','a'=>'saveform'),$_smarty_tpl);?>
" method=POST>
		    <ul class="forminfo">
		    <li><label>订单编号</label><input id="orderNo" name="orderNo" type="text" class="dfinput" maxlength="30" /></li>
		    <li><label>所属公司</label><cite><input id="who" name="who" type="radio" value="1" checked="checked" />森大&nbsp;&nbsp;&nbsp;&nbsp;<input name="who" type="radio" value="2" />碧海洋</cite></li>

		    <li ><label>货品列表</label>
		    
		    <ul class="dfinput-select">
		    
		    </ul>
		    
		    &nbsp;&nbsp;<a href="#" onclick="show_product_list()"><em class="choose">...</em></a></li>
		    
		    <li><label>供应商</label><div id="unit" type="text" class="dfinput-single" ></div>&nbsp;&nbsp;<a href="#" onclick="show_unit_list()"><em class="choose">...</em></a></li>
		    <li><label>订单时间</label><input id="orderTime" name="orderTime" type="text" class="dfinput" readonly="readonly" />&nbsp;&nbsp;<a href="#" onclick="show_date_list()"><em class="choose">...</em></a></li>
		    <li><label>备注</label><textarea id="remark" name="remark" cols="" rows="" class="textinput" maxlength="300"></textarea></li>
		    <li><label>&nbsp;</label><input type="button" id="btn_submit" class="btn" value="确认保存"/></li>
		    <input type=hidden id="submit_unit" name="unitId" />
		    <input type=hidden id="submit_detail" name="detail" />
		    </ul>
	    </form>

				    

    
    </div>

    <div class="objectlist">
    	<div class="tiptop"><span id="list_title">货品列表(单击添加至订单)</span></div>
      <div class="objectlistcontent">
      
      	<div id="dateWidgetContainer" style="display:none"><input id="dateWidget" style="display:none" type="text" class="w8em format-y-m-d divider-dash highlight-days-12 no-fade" maxlength="10" /></div>

      <div id="obj_filter">	<input name="no" id="filter_key" type="text" class="dfinput" style="width:190px;" />
      <a href="#" onclick="filter()">
      <span class="filter">筛选</span></a></div>
        <ul class="obj_items"></ul>
    
    </div>
    

</body>

</html>
