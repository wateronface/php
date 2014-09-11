<?php
class o_order_action extends spController
{
	function index(){
		$o_order = spClass("o_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT 

			(SELECT COUNT(*) FROM o_order_detail X WHERE x.orderId=o.id) productCount,
			
			GROUP_CONCAT(p.name,'(',d.price,')',' x ',d.amount SEPARATOR '<br>') AS productDetail,
			
			IFNULL((SELECT SUM(money) FROM o_pay  WHERE o_pay.orderId=o.id),0) money_payed,
			IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0) money_all,
			FORMAT(IFNULL(IFNULL((SELECT SUM(money) FROM o_pay  WHERE o_pay.orderId=o.id),0)/IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0),0),2)*100 payPct,
			
			
			IFNULL((SELECT SUM(amount) FROM o_stock  WHERE o_stock.orderId=o.id),0) amount_stocked,
			IFNULL((SELECT SUM(amount) FROM o_order_detail z WHERE z.orderId=o.id),0) amount_all,
			FORMAT(IFNULL(IFNULL((SELECT SUM(amount) FROM o_stock  WHERE o_stock.orderId=o.id),0)/IFNULL((SELECT SUM(amount) FROM o_order_detail z WHERE z.orderId=o.id),0),0),2)*100 stockPct,
			
			
			IFNULL((SELECT SUM(money) FROM o_invoice  WHERE o_invoice.orderId=o.id),0) invoice_received,
			IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0) invoice_all,
			FORMAT(IFNULL(IFNULL((SELECT SUM(money) FROM o_invoice  WHERE o_invoice.orderId=o.id),0)/IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0),0),2)*100 invoicePct,
			
			
			u.unitName,IF(o.who=1,'森大','碧海洋') who,
			o.remark,
			o.orderNo,
			o.username,
			o.id,
			o.orderTime,
			o.updateTime	
			FROM o_order o 
			LEFT JOIN o_order_detail d ON d.orderId = o.id 
			LEFT JOIN product p ON d.productId = p.id  
			LEFT JOIN unit u ON o.unitId = u.id 
			GROUP BY o.id  	
		";
        $like_sql = $this->getLikeSql($search_key,"id","remark","orderNo","unitName","productCount","productDetail","money_payed","money_all","amount_stocked","amount_all","username","who");
        $this->results = $o_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY o.id desc"); 
        $this->search_key = $search_key;
        $this->pager = $o_order->spPager()->getPager();
//        echo $o_order->dumpSql();
        $this->display("o_order_index.htm"); // 显示模板
	}
	function addform(){
		$this->action='add';
		$product = spClass("product"); 
		$unit = spClass("unit"); 
		$this->products = $product->findAll(null,'id desc'); 
		$this->units = $unit->findAll(array('type'=>1),'id desc'); 
		//echo $unit->dumpSql();
        $this->display("o_order_addform.htm"); // 显示模板
	}
	function addsave(){
		$o_order = spClass("o_order"); 
		$orderTime = $this->__get('orderTime');
		$row = $this->spArgs();
		$row["username"] = $_SESSION["username"];
		
		$this->results = spUrl("o_order_action", "index"); ;
        $o_order->create($row);
        $order_id = mysql_insert_id();
        $args = $this->spArgs();
        //插入o_order_detail表
        $o_order_detail = spClass("o_order_detail");
        
        if(strlen(trim($args['detail']))>0){
        	$records = explode("@@@", $args['detail']);
        	for($i=0;$i<sizeOf($records);$i++){
        	 $single = $records[$i];
        	 $arr = explode("___",$single);
        	 
        	 $conditions = array("orderId"=>$order_id,"productId"=>$arr[0],"price"=>$arr[1],"amount"=>$arr[2]);
        	 
        	 $o_order_detail->create($conditions);
        	}
        }
       $this->display("ok.htm"); // 显示模板
	}
	
	function deleteselect(){
		$o_order = spClass("o_order");
		
		$o_order_detail = spClass("o_order_detail");
		
		$o_pay = spClass("o_pay");
		
		$o_stock = spClass("o_stock");
		
		$o_invoice = spClass("o_invoice");
		
		$param = $this->spArgs();
		if(sizeof($param['chk_list'])>0){
			foreach($param['chk_list'] as $id){
				//五表连删
				$o_order->delete(array("id"=>$id));
				$o_order_detail->delete(array("orderId"=>$id));
				$o_pay->delete(array("orderId"=>$id));
				$o_stock->delete(array("orderId"=>$id));
				$o_invoice->delete(array("orderId"=>$id));
			}
		}
//		echo $o_order->dumpSql();
		$this->results = spUrl("o_order_action", "index"); ;
        $this->display("ok.htm"); // 显示模板
	}
	function updateform(){
		$this->action='update';
		
		$param = $this->spArgs();
		$orderId = $param['chk_list'][0];
		
		//查询货品和单位
		$product = spClass("product"); 
		$this->products = $product->findAll(null,'id desc'); 
		$unit = spClass("unit"); 
		$this->units = $unit->findAll(array('type'=>0),'id desc'); 
		
		//查询订单信息
		$o_order = spClass("o_order"); 
		$this->o_order = $o_order->find(array('id'=>$orderId));  
		
		
		//查询所选订单的详细（货品名称*货品数量）
		$o_order_detail = spClass("o_order_detail"); 
		$this->productDetailList = $o_order_detail->findSql("SELECT p.id,price,amount,p.name FROM o_order_detail d LEFT JOIN product p ON d.productId = p.id  WHERE d.orderId = $orderId");
//		dump($this->productDetailList);
		$model = spClass("o_order");
//		echo $model->dumpSql();
		$this->display("o_order_addform.htm"); // 显示模板
	}
	function updatesave(){
		
		//更新o_order表
        $o_order = spClass("o_order"); 
        $row = $this->spArgs();
        $order_id = $row['id'];
		$orderTime = $row['orderTime'];
		$row["username"] = $_SESSION["username"];
		$conditions = array('id'=>$row['id']); 
		
		$o_order->update($conditions,$row);
//		echo $o_order->dumpSql();
		
        
        //删除o_order_detail表中的有关$order_id记录
        $o_order_detail = spClass("o_order_detail"); 
        $o_order_detail->delete(array('orderId'=>$order_id));
        
        
        //插入o_order_detail表
        $o_order_detail = spClass("o_order_detail");
        
        if(strlen(trim($row['detail']))>0){
        	$records = explode("@@@", $row['detail']);
        	for($i=0;$i<sizeOf($records);$i++){
        	 $single = $records[$i];
        	 $arr = explode("___",$single);
        	 
        	 $conditions = array("orderId"=>$order_id,"productId"=>$arr[0],"price"=>$arr[1],"amount"=>$arr[2]);
        	 
        	 $o_order_detail->create($conditions);
        	}
        }
       $this->results = spUrl("o_order_action", "index");
       $this->display("ok.htm"); // 显示模板
        
        
        
	}
	function left(){
        $this->display("o_left.htm"); // 显示模板，这里使用的模板是根目录/tpl/green/index.html。
	}

}