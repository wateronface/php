<?php
class i_stock_action extends spController
{



	function index(){
		$model = spClass("product"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "SELECT k.* ,o.orderNo,IF(o.who=1,'森大','碧海洋') who,u.unitName,p.name FROM i_stock k LEFT JOIN i_order o ON k.orderId = o.id LEFT JOIN unit u ON o.unitId = u.id LEFT JOIN product p ON p.id = k.productId ";
		$like_sql = $this->getLikeSql($search_key,"k.username","o.orderNo","name","who","unitName","amount");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY k.id desc"); 
		$this->search_key = $search_key;
        $this->pager = $model->spPager()->getPager();
        //echo($model->dumpSql());
        $this->display("i_stock_index.htm"); // 显示模板
	}


	//显示发票登记表单
	function addform(){
		//先查出订单详细
		$i_order = spClass("i_order"); 
		$param = $this->spArgs();
		$order_id = $param['chk_list'][0];
		//$conditions = array('id'=>$order_id); 
		$results = $i_order->findSql("SELECT (SELECT COUNT(*) FROM i_order_detail X WHERE x.orderId=o.id) productCount,GROUP_CONCAT(p.name,' * ',d.amount SEPARATOR '<br>') AS productDetail,(SELECT SUM(price * amount) FROM i_order_detail X WHERE x.orderId=o.id) money,u.unitName,o.* FROM i_order o LEFT JOIN i_order_detail d ON d.orderId = o.id LEFT JOIN product p ON d.productId = p.id  LEFT JOIN unit u ON o.unitId = u.id GROUP BY o.id  HAVING o.id = $order_id"); 
		$this->order = $results[0];
		$i_order_detail = spClass("i_order_detail"); 
		$this->product_list = $i_order_detail->findSql("SELECT d.*,p.name,(SELECT SUM(amount) FROM i_stock k WHERE k.productId=d.productId AND k.orderId=d.orderId) amount_received FROM i_order_detail d LEFT JOIN product p ON d.productId=p.id WHERE d.orderId=".$order_id." ORDER BY d.id desc");
        $this->display("i_stock_addform.htm"); // 显示模板
	}

	//保存发票登记表单
	function addsave(){
		$param = $this->spArgs();
		$orderId = $param["orderId"];
		$amountArray = $param["amount"];
		$productIdArray = $param["productId"];
		$validTimeArray = $param["validTime"];
		$i_stock = spClass("i_stock"); 
		for($i=0;$i<sizeOf($amountArray);$i++){
			$row = array();
			$row["orderId"]=$orderId;
			$row["productId"]=$productIdArray[$i];
			$row["amount"]=$amountArray[$i];
			$row["validTime"]=$validTimeArray[$i];
			$row["username"]=$_SESSION["username"];	
			$i_stock->create($row);
		}
       
        $this->results = spUrl("i_stock_action", "index"); ;
        $this->display("ok.htm"); // 显示模板
	}


	function deleteselect() {
		$i_order = spClass("i_stock");
		$param = $this->spArgs();
		if (sizeof($param['chk_list']) > 0) {
			foreach ($param['chk_list'] as $id) {
				$i_order->deleteByPk($id);
			}
		}
		$this->results = spUrl("i_stock_action", "index");
		;
		$this->display("ok.htm"); // 显示模板
	}
	function updatesave() {
		$i_order = spClass("i_order");
		$param = $this->spArgs();
		$conditions = array (
			'id' => $param['chk_list'][0]
		);
		$this->results = $i_order->find($conditions);
		$this->display("i_order_updateform.htm"); // 显示模板
	}








}