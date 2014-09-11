<?php
class stat_action extends spController
{

	function top(){
		//这里需要判断session
        $this->display("top.htm"); // 显示模板
	}
	
	function left(){
		//这里需要判断session
		
        $this->display("stat_left.htm"); // 显示模板
	}
	
	//总览
	function index(){
	
		$model = spClass("product"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
		SELECT 
			id,
			no,
			name,
			spec,
			unit,
			remark,
			init + IFNULL((SELECT SUM(amount) FROM i_stock WHERE i_stock.productId=p.id),0)-IFNULL((SELECT SUM(amount) FROM o_stock WHERE o_stock.productId=p.id),0) today
		FROM product p";
    	$like_sql = $this->getLikeSql($search_key,"no","name","spec","unit","remark","today");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY p.id"); 
		$this->search_key = $search_key;
        $this->pager = $model->spPager()->getPager();
		$this->display("stat_index.htm"); // 显示模板
	}
	
	//库存明细表（用某货品的全部入库-全部出库+初始库存）
	function stat1(){
		$this->display("stat_index.htm"); 
	}
	//----------------------------------------------------------下面可以做-------------------------
	//未到货明细表（时间、数量、商品ID）-用入库记录查
	function stat2(){
		$model = spClass("product"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "SELECT
  o.orderTime,
  
  IF(IFNULL(d.amount,0)-(SELECT
     SUM(k.amount)
   FROM i_stock k
   WHERE k.productId = d.productId
       AND k.orderId = d.orderId)=0,'在库','未到') receive_status,
  p.id,
  p.name,
  p.spec,
  p.unit,
  IFNULL(d.amount,0) amount,
  IFNULL(d.price,0) price,
  IFNULL(d.amount*d.price,0) AS money,
  u.unitName,
  k.validTime,
  IF(o.who=1,'森大','碧海洋') who,
  (SELECT
     SUM(amount)
   FROM i_stock k
   WHERE k.productId = d.productId
       AND k.orderId = d.orderId)    amount_received
FROM i_order_detail d
  LEFT JOIN product p
    ON d.productId = p.id LEFT JOIN i_order o ON o.id = d.orderId LEFT JOIN unit u ON o.unitId=u.id LEFT JOIN i_stock k ON k.productId=d.productId AND k.orderId = d.orderId
    
    GROUP BY o.orderTime,p.id";
    	$like_sql = $this->getLikeSql($search_key,"receive_status","name","spec","unit","amount","price","money","unitName","who");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY d.id desc"); 
		$this->search_key = $search_key;
        $this->pager = $model->spPager()->getPager();
		$this->display("stat_2.htm"); // 显示模板
	}
	
	//供应商未开票明细表-用发票登记记录查
	function stat3(){
	$i_order = spClass("i_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT 

			(SELECT COUNT(*) FROM i_order_detail X WHERE x.orderId=o.id) productCount,
			
			GROUP_CONCAT(p.name,'(',d.price,'元)',' x ',d.amount,'(',p.unit,')' SEPARATOR '<br>') AS productDetail,
			
			IFNULL((SELECT SUM(money) FROM i_pay  WHERE i_pay.orderId=o.id),0) money_payed,
			IFNULL((SELECT SUM(price * amount) FROM i_order_detail z WHERE z.orderId=o.id),0) money_all,
		
			
			IFNULL((SELECT SUM(amount) FROM i_stock  WHERE i_stock.orderId=o.id),0) amount_stocked,
			IFNULL((SELECT SUM(amount) FROM i_order_detail z WHERE z.orderId=o.id),0) amount_all,
			
			
			
			IFNULL((SELECT SUM(money) FROM i_invoice  WHERE i_invoice.orderId=o.id),0) invoice_received,
			IFNULL((SELECT SUM(price * amount) FROM i_order_detail z WHERE z.orderId=o.id),0)-IFNULL((SELECT SUM(money) FROM i_invoice  WHERE i_invoice.orderId=o.id),0) invoice_not_received,
			
			
			
			u.unitName,IF(o.who=1,'森大','碧海洋') who,
			o.remark,
			o.orderNo,
			o.username,
			o.id,
			o.orderTime,
			o.updateTime	
			FROM i_order o 
			LEFT JOIN i_order_detail d ON d.orderId = o.id 
			LEFT JOIN product p ON d.productId = p.id  
			LEFT JOIN unit u ON o.unitId = u.id 
			WHERE IFNULL((SELECT SUM(price * amount) FROM i_order_detail z WHERE z.orderId=o.id),0)-IFNULL((SELECT SUM(money) FROM i_invoice  WHERE i_invoice.orderId=o.id),0)>0
			GROUP BY o.id  	
		";
        $like_sql = $this->getLikeSql($search_key,"orderNo","unitName","productCount","productDetail","who","money_all","invoice_received","invoice_not_received");
        $this->results = $i_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY o.id desc"); 
        $this->search_key = $search_key;
        $this->pager = $i_order->spPager()->getPager();
        $this->display("stat_3.htm"); // 显示模板
		
	}
	
	//供应商未开票汇总表-用发票登记记录先SUM，后用供应商GROUP BY
	function stat4(){
	$i_order = spClass("i_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT * FROM (
			SELECT  
			o.id,
			u.unitName,
			IFNULL(SUM(d.price * d.amount),0) money_all,
			IFNULL(SUM(v.money),0) invoice_received,
			IFNULL(SUM(d.price * d.amount),0) - IFNULL(SUM(v.money),0) invoice_not_received,
			IF(o.who=1,'森大','碧海洋') who
			
			
					FROM i_order o
			INNER JOIN unit u
				ON o.unitId = u.id
			INNER JOIN i_order_detail d
				ON o.id = d.orderId
			LEFT  JOIN i_invoice v
				ON o.id = v.orderId
			

			GROUP BY  o.unitId,o.who  	) t 
			WHERE t.invoice_not_received >0
		";
        $like_sql = $this->getLikeSql($search_key,"money_all","invoice_received","invoice_not_received","unitName","who");
        $this->results = $i_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY id desc"); 
        $this->search_key = $search_key;
        $this->pager = $i_order->spPager()->getPager();
        $this->display("stat_4.htm"); // 显示模板
		
	}
	
	//应付款明细表-用打款记录查
	function stat5(){
		$i_order = spClass("i_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT 

			(SELECT COUNT(*) FROM i_order_detail X WHERE x.orderId=o.id) productCount,
			
			GROUP_CONCAT(p.name,'(',d.price,'元)',' x ',d.amount,'(',p.unit,')' SEPARATOR '<br>') AS productDetail,
			
			IFNULL((SELECT SUM(money) FROM i_pay  WHERE i_pay.orderId=o.id),0) money_payed,
			IFNULL((SELECT SUM(price * amount) FROM i_order_detail z WHERE z.orderId=o.id),0) money_all,
		
			IFNULL((SELECT SUM(price * amount) FROM i_order_detail z WHERE z.orderId=o.id),0)-IFNULL((SELECT SUM(money) FROM i_pay  WHERE i_pay.orderId=o.id),0) money_not_payed,
			
			u.unitName,IF(o.who=1,'森大','碧海洋') who,
			o.remark,
			o.orderNo,
			o.username,
			o.id,
			o.orderTime,
			o.updateTime	
			FROM i_order o 
			LEFT JOIN i_order_detail d ON d.orderId = o.id 
			LEFT JOIN product p ON d.productId = p.id  
			LEFT JOIN unit u ON o.unitId = u.id 
			WHERE IFNULL((SELECT SUM(price * amount) FROM i_order_detail z WHERE z.orderId=o.id),0)-IFNULL((SELECT SUM(money) FROM i_pay  WHERE i_pay.orderId=o.id),0)>0
			GROUP BY o.id  	
		";
        $like_sql = $this->getLikeSql($search_key,"orderNo","unitName","productCount","productDetail","who","money_all","money_not_payed","money_payed");
        $this->results = $i_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY o.id desc"); 
        $this->search_key = $search_key;
        $this->pager = $i_order->spPager()->getPager();
        $this->display("stat_5.htm"); // 显示模板
		
	}
	
	//应付款汇总表-用打款记录查
	function stat6(){
	
	$i_order = spClass("i_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT * FROM (
			SELECT  
			o.id,
			u.unitName,
			IFNULL(SUM(d.price * d.amount),0) money_all,
			IFNULL(SUM(p.money),0) money_payed,
			IFNULL(SUM(d.price * d.amount),0) - IFNULL(SUM(p.money),0)  money_not_payed,
			IF(o.who=1,'森大','碧海洋') who
			
			
					FROM i_order o
			INNER JOIN unit u
				ON o.unitId = u.id
			INNER JOIN i_order_detail d
				ON o.id = d.orderId
			LEFT  JOIN i_pay p
				ON o.id=p.orderId
			

			GROUP BY  o.unitId,o.who  
		 	) t 
			WHERE t.money_not_payed >0
		";
        $like_sql = $this->getLikeSql($search_key,"money_all","money_payed","money_not_payed","unitName","who");
        $this->results = $i_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY id desc"); 
        $this->search_key = $search_key;
        $this->pager = $i_order->spPager()->getPager();
        $this->display("stat_6.htm"); // 显示模板
		
		
	}
	//----------------------------------------------------------上面可以做-------------------------
	//欠货明细表-用出库记录查
	function stat7(){
	
		$model = spClass("product"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "SELECT
  o.orderTime,
  
  IF(IFNULL(d.amount,0)-(SELECT
     SUM(k.amount)
   FROM o_stock k
   WHERE k.productId = d.productId
       AND k.orderId = d.orderId)=0,'在库','未到') receive_status,
  p.id,
  p.name,
  p.spec,
  p.unit,
  IFNULL(d.amount,0) amount,
  IFNULL(d.price,0) price,
  IFNULL(d.amount*d.price,0) AS money,
  u.unitName,
  k.validTime,
  IF(o.who=1,'森大','碧海洋') who,
  (SELECT
     SUM(amount)
   FROM o_stock k
   WHERE k.productId = d.productId
       AND k.orderId = d.orderId)    amount_received
FROM o_order_detail d
  LEFT JOIN product p
    ON d.productId = p.id LEFT JOIN o_order o ON o.id = d.orderId LEFT JOIN unit u ON o.unitId=u.id LEFT JOIN o_stock k ON k.productId=d.productId AND k.orderId = d.orderId
    
    GROUP BY o.orderTime,p.id";
    	$like_sql = $this->getLikeSql($search_key,"receive_status","name","spec","unit","amount","price","money","unitName","who");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY d.id desc"); 
		$this->search_key = $search_key;
        $this->pager = $model->spPager()->getPager();
		$this->display("stat_7.htm"); // 显示模板
		
	}
	
	//客户未开票明细表-用开发票记录查
	function stat8(){
	
	$o_order = spClass("o_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT 

			(SELECT COUNT(*) FROM o_order_detail X WHERE x.orderId=o.id) productCount,
			
			GROUP_CONCAT(p.name,'(',d.price,'元)',' x ',d.amount,'(',p.unit,')' SEPARATOR '<br>') AS productDetail,
			
			IFNULL((SELECT SUM(money) FROM o_pay  WHERE o_pay.orderId=o.id),0) money_payed,
			IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0) money_all,
		
			
			IFNULL((SELECT SUM(amount) FROM o_stock  WHERE o_stock.orderId=o.id),0) amount_stocked,
			IFNULL((SELECT SUM(amount) FROM o_order_detail z WHERE z.orderId=o.id),0) amount_all,
			
			
			
			IFNULL((SELECT SUM(money) FROM o_invoice  WHERE o_invoice.orderId=o.id),0) invoice_received,
			IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0)-IFNULL((SELECT SUM(money) FROM o_invoice  WHERE o_invoice.orderId=o.id),0) invoice_not_received,
			
			
			
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
			WHERE IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0)-IFNULL((SELECT SUM(money) FROM o_invoice  WHERE o_invoice.orderId=o.id),0)>0
			GROUP BY o.id  	
		";
        $like_sql = $this->getLikeSql($search_key,"orderNo","unitName","productCount","productDetail","who","money_all","invoice_received","invoice_not_received");
        $this->results = $o_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY o.id desc"); 
        $this->search_key = $search_key;
        $this->pager = $o_order->spPager()->getPager();
        $this->display("stat_8.htm"); // 显示模板
		
	}
	
	//客户未开票汇总表-用开发票记录查
	function stat9(){
	
	$o_order = spClass("o_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT * FROM (
			SELECT  
			o.id,
			u.unitName,
			IFNULL(SUM(d.price * d.amount),0) money_all,
			IFNULL(SUM(v.money),0) invoice_received,
			IFNULL(SUM(d.price * d.amount),0) - IFNULL(SUM(v.money),0) invoice_not_received,
			IF(o.who=1,'森大','碧海洋') who
			
			
					FROM o_order o
			INNER JOIN unit u
				ON o.unitId = u.id
			INNER JOIN o_order_detail d
				ON o.id = d.orderId
			LEFT  JOIN o_invoice v
				ON o.id = v.orderId
			

			GROUP BY  o.unitId,o.who  	) t 
			WHERE t.invoice_not_received >0
		";
        $like_sql = $this->getLikeSql($search_key,"money_all","invoice_received","invoice_not_received","unitName","who");
        $this->results = $o_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY id desc"); 
        $this->search_key = $search_key;
        $this->pager = $o_order->spPager()->getPager();
        $this->display("stat_9.htm"); // 显示模板
		
		
	}
	
	//应收款明细表-用回款记录查
	function stat10(){
	
		$o_order = spClass("o_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT 

			(SELECT COUNT(*) FROM o_order_detail X WHERE x.orderId=o.id) productCount,
			
			GROUP_CONCAT(p.name,'(',d.price,'元)',' x ',d.amount,'(',p.unit,')' SEPARATOR '<br>') AS productDetail,
			
			IFNULL((SELECT SUM(money) FROM o_pay  WHERE o_pay.orderId=o.id),0) money_payed,
			IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0) money_all,
		
			IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0)-IFNULL((SELECT SUM(money) FROM o_pay  WHERE o_pay.orderId=o.id),0) money_not_payed,
			
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
			WHERE IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0)-IFNULL((SELECT SUM(money) FROM o_pay  WHERE o_pay.orderId=o.id),0)>0
			GROUP BY o.id  	
		";
        $like_sql = $this->getLikeSql($search_key,"orderNo","unitName","productCount","productDetail","who","money_all","money_not_payed","money_payed");
        $this->results = $o_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY o.id desc"); 
        $this->search_key = $search_key;
        $this->pager = $o_order->spPager()->getPager();
        $this->display("stat_10.htm"); // 显示模板
		
	}
	
	//应收款汇总表-用回款记录查
	function stat11(){
	
	
	$o_order = spClass("o_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT * FROM (
			SELECT  
			o.id,
			u.unitName,
			IFNULL(SUM(d.price * d.amount),0) money_all,
			IFNULL(SUM(p.money),0) money_payed,
			IFNULL(SUM(d.price * d.amount),0) - IFNULL(SUM(p.money),0)  money_not_payed,
			IF(o.who=1,'森大','碧海洋') who
			
			
					FROM o_order o
			INNER JOIN unit u
				ON o.unitId = u.id
			INNER JOIN o_order_detail d
				ON o.id = d.orderId
			LEFT  JOIN o_pay p
				ON o.id=p.orderId
			

			GROUP BY  o.unitId,o.who  
		 	) t 
			WHERE t.money_not_payed >0
		";
        $like_sql = $this->getLikeSql($search_key,"money_all","money_payed","money_not_payed","unitName","who");
        $this->results = $o_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY id desc"); 
        $this->search_key = $search_key;
        $this->pager = $o_order->spPager()->getPager();
        $this->display("stat_11.htm"); // 显示模板
		
		
	}
	
	//已开票明细表-用开发票记录查
	function stat12(){
	$o_order = spClass("o_order"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
			SELECT 

			(SELECT COUNT(*) FROM o_order_detail X WHERE x.orderId=o.id) productCount,
			
			GROUP_CONCAT(p.name,'(',d.price,'元)',' x ',d.amount,'(',p.unit,')' SEPARATOR '<br>') AS productDetail,
			
			IFNULL((SELECT SUM(money) FROM o_pay  WHERE o_pay.orderId=o.id),0) money_payed,
			IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0) money_all,
		
			
			IFNULL((SELECT SUM(amount) FROM o_stock  WHERE o_stock.orderId=o.id),0) amount_stocked,
			IFNULL((SELECT SUM(amount) FROM o_order_detail z WHERE z.orderId=o.id),0) amount_all,
			
			
			
			IFNULL((SELECT SUM(money) FROM o_invoice  WHERE o_invoice.orderId=o.id),0) invoice_received,
			IFNULL((SELECT SUM(price * amount) FROM o_order_detail z WHERE z.orderId=o.id),0)-IFNULL((SELECT SUM(money) FROM o_invoice  WHERE o_invoice.orderId=o.id),0) invoice_not_received,
			
			
			
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
			WHERE IFNULL((SELECT SUM(money) FROM o_invoice  WHERE o_invoice.orderId=o.id),0)>0
			GROUP BY o.id  	
		";
        $like_sql = $this->getLikeSql($search_key,"orderNo","unitName","productCount","productDetail","who","money_all","invoice_received","invoice_not_received");
        $this->results = $o_order->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY o.id desc"); 
        $this->search_key = $search_key;
        $this->pager = $o_order->spPager()->getPager();
        $this->display("stat_12.htm"); // 显示模板
		
	}
}