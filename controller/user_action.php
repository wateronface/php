<?php
class user_action extends spController
{
	
	function index(){
		$model = spClass("user"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "select * from user";
		$like_sql = $this->getLikeSql($search_key,"username","role");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY id desc"); 
		$this->search_key = $search_key;
        $this->pager = $model->spPager()->getPager();
        //echo($model->dumpSql());
        $this->display("user_index.htm"); // 显示模板
	}
	
	function addform(){
        $this->display("user_addform.htm"); // 显示模板
	}
	function addsave(){
		$model = spClass("user"); 
		$username = $this->spArgs('username', null);
		$count = $model->findCount(array('username'=>$username));
		$this->results = spUrl("user_action", "index"); ;
		if($count>0){
			$this->display("error.htm"); // 显示模板
		}else{
			$row = array_merge($this->spArgs(),array("creator"=>$_SESSION['username']));
	        $model->create($row);
	        $this->display("ok.htm"); // 显示模板
		}
	}
	
	function deleteselect(){
		$model = spClass("user");
		$param = $this->spArgs();
		if(sizeof($param['chk_list'])>0){
			foreach($param['chk_list'] as $id){
				$model->deleteByPk($id);
				
				//进货表操作
				
				
				//根据username删i_pay表
				$model->query("delete from i_pay where username in (select username from user where id=$id)");
				//根据username删i_stock表
				$model->query("delete from i_stock where username in (select username from user where id=$id)");
				//根据username删i_invoice表
				$model->query("delete from i_invoice where username in (select username from user where id=$id)");
				//根据username删i_order_detail表
				$model->query("delete from i_order_detail where orderId in (select id from i_order where username in(select username from user where id=$id))");
				//根据username删i_order表
				$model->query("delete from i_order where username in (select username from user where id=$id)");
				
				
				//销售表操作
				
				//根据username删i_pay表
				$model->query("delete from o_pay where username in (select username from user where id=$id)");
				//根据username删i_stock表
				$model->query("delete from o_stock where username in (select username from user where id=$id)");
				//根据username删i_invoice表
				$model->query("delete from o_invoice where username in (select username from user where id=$id)");
				//根据username删i_order_detail表
				$model->query("delete from o_order_detail where orderId in (select id from o_order where username in(select username from user where id=$id))");
				//根据username删i_order表
				$model->query("delete from o_order where username in (select username from user where id=$id)");
				
				
				//根据ID删用户表
				$model->deleteByPk($id);
				
				
			}
		}
		$this->results = spUrl("user_action", "index");
        $this->display("ok.htm"); // 显示模板
	}
	function updateform(){
		$this->action='update';
		$model = spClass("user");
		$param = $this->spArgs();
		$conditions = array('id'=>$param['chk_list'][0]); 
		$this->user = $model->find($conditions);  
		$this->display("user_addform.htm"); // 显示模板
	}
	function updatesave(){
		$model = spClass("user");
		$param = $this->spArgs();
		$conditions = array('id'=>$param['id']); 
		$model->update($conditions,$param );  
//		echo($model->dumpSql());
		$this->results = spUrl("user_action", "index");
        $this->display("ok.htm"); // 显示模板
	}
}