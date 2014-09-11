<?php
class unit_action extends spController
{
	
	
	function index(){
		$type = $this->spArgs('type', 0);
		$model = spClass("unit"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "select * from unit where type= $type ";
		$like_sql = $this->getLikeSql($search_key,"unitName","unitCode","unitAddress","unitPeople","unitPhone","username","remark");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY id desc"); 
		$this->search_key = $search_key;
        $this->pager = $model->spPager()->getPager();
        //echo($model->dumpSql());
        $this->display("unit_index.htm"); // 显示模板
	}
	
	
	function addform(){
		$this->action='add';
        $this->display("unit_addform.htm"); // 显示模板
	}
	function addsave(){
		$model = spClass("unit"); 
		$type = $this->spArgs('type', 0);
		$this->alert($type);
		$row = $this->spArgs();
		//$row = array_merge($this->spArgs(),array("username"=>$_SESSION["username"]));
		$row["username"] = $_SESSION["username"];
		$row["type"] = $type;
		$this->results = spUrl("unit_action", "index",array("type"=>$type));
        $model->create($row);
        $this->display("ok.htm"); // 显示模板
	}
	
	function deleteselect(){
		$model = spClass("user");
		$param = $this->spArgs();
		if(sizeof($param['chk_list'])>0){
			foreach($param['chk_list'] as $id){
				$model->deleteByPk($id);
				
				//进货表操作
				
				//根据单位ID删单位表
				$model->deleteByPk($id);
				//根据单位ID删i_pay表
				$model->query("delete from i_pay where orderId in (select orderId from i_order where unitId=$id)");
				//根据单位ID删i_stock表
				$model->query("delete from i_stock where orderId in (select orderId from i_order where unitId=$id)");
				//根据单位ID删i_invoice表
				$model->query("delete from i_invoice where orderId in (select orderId from i_order where unitId=$id)");
				//根据单位ID删i_order_detail表
				$model->query("delete from i_order_detail where orderId in (select orderId from i_order where unitId=$id)");
				//根据单位ID删i_order表
				$model->query("delete from i_order where unitId = $id");
				
				
				//销售表操作
				
				//根据单位ID删单位表
				$model->deleteByPk($id);
				//根据单位ID删i_pay表
				$model->query("delete from o_pay where orderId in (select orderId from o_order where unitId=$id)");
				//根据单位ID删i_stock表
				$model->query("delete from o_stock where orderId in (select orderId from o_order where unitId=$id)");
				//根据单位ID删i_invoice表
				$model->query("delete from o_invoice where orderId in (select orderId from o_order where unitId=$id)");
				//根据单位ID删i_order_detail表
				$model->query("delete from o_order_detail where orderId in (select orderId from o_order where unitId=$id)");
				//根据单位ID删i_order表
				$model->query("delete from o_order where unitId = $id");
				
				
			}
		}
		$this->results = spUrl("user_action", "index");
		
        $this->display("ok.htm"); // 显示模板
	}
	
	function updateform(){
		$this->action='update';
		$model = spClass("unit");
		$param = $this->spArgs();
		$conditions = array('id'=>$param['chk_list'][0]); 
		$this->unit = $model->find($conditions);  
		$this->display("unit_addform.htm"); // 显示模板
	}
	function updatesave(){
		$type = $this->spArgs('type', 0);
		$model = spClass("unit");
		$param = $this->spArgs();
		$conditions = array('id'=>$param['id']); 
		$model->update($conditions,$param );  
//		echo($model->dumpSql());
		$this->results = spUrl("unit_action", "index",array("type"=>$type));
        $this->display("ok.htm"); // 显示模板
	}
}