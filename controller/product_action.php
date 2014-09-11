<?php
class product_action extends spController
{
	function index(){
		$model = spClass("product"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "SELECT * from product ";
		$like_sql = $this->getLikeSql($search_key,"no","name","spec","unit","init","username","remark");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." order by id desc"); 
		$this->search_key = $search_key;
        $this->pager = $model->spPager()->getPager();
        //echo($model->dumpSql());
        $this->display("product_index.htm"); // 显示模板
	}
	function addform(){
		$this->action='add';
        $this->display("product_addform.htm"); // 显示模板
	}
	function addsave(){
		$model = spClass("product"); 
		$row = array_merge($this->spArgs(),array("username"=>$_SESSION["username"]));
		$this->results = spUrl("product_action", "index"); ;
        $model->create($row);
        $this->display("ok.htm"); // 显示模板
	}
	
	function deleteselect(){
		$model = spClass("product");
		$param = $this->spArgs();
		if(sizeof($param['chk_list'])>0){
			foreach($param['chk_list'] as $id){
				//进货表操作
				
				//根据货品ID删货品表
				$model->deleteByPk($id);
				//根据货品ID删i_pay表
				$model->query("delete from i_pay where orderId in (select orderId from i_order_detail where productId=$id)");
				//根据货品ID删i_stock表
				$model->query("delete from i_stock where orderId in (select orderId from i_order_detail where productId=$id)");
				//根据货品ID删i_invoice表
				$model->query("delete from i_invoice where orderId in (select orderId from i_order_detail where productId=$id)");
				//根据货品ID删i_order表
				$model->query("delete from i_order where id in (select orderId from i_order_detail where productId=$id)");
				//根据货品ID删i_order_detail表
				$model->query("delete from i_order_detail where productId=$id)");
				
				//销售表操作
				
				//根据货品ID删货品表
				$model->deleteByPk($id);
				//根据货品ID删i_pay表
				$model->query("delete from o_pay where orderId in (select orderId from o_order_detail where productId=$id)");
				//根据货品ID删i_stock表
				$model->query("delete from o_stock where orderId in (select orderId from o_order_detail where productId=$id)");
				//根据货品ID删i_invoice表
				$model->query("delete from o_invoice where orderId in (select orderId from o_order_detail where productId=$id)");
				//根据货品ID删i_order表
				$model->query("delete from o_order where id in (select orderId from o_order_detail where productId=$id)");
				//根据货品ID删i_order_detail表
				$model->query("delete from o_order_detail where productId=$id)");
			}
		}
		$this->results = spUrl("product_action", "index");
        $this->display("ok.htm"); // 显示模板
	}
	function updateform(){
		$this->action='update';
		$model = spClass("product");
		$param = $this->spArgs();
		$conditions = array('id'=>$param['chk_list'][0]); 
		$this->product = $model->find($conditions);  
		$this->display("product_addform.htm"); // 显示模板
	}
	function updatesave(){
		$model = spClass("product");
		$param = $this->spArgs();
		$conditions = array('id'=>$param['id']); 
		$model->update($conditions,$param );  
//		echo($model->dumpSql());
		$this->results = spUrl("product_action", "index");
        $this->display("ok.htm"); // 显示模板
	}
	function left(){
		//这里需要判断session
		
        $this->display("setup_left.htm"); // 显示模板，这里使用的模板是根目录/tpl/green/index.html。
	}
}