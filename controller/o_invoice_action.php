<?php
class o_invoice_action extends spController
{



	function index(){
		$model = spClass("product"); 
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "
				SELECT
				i.id,
				i.invoiceNo ,
				i.money,
				i.invoiceTime,
				i.username,
				i.updateTime,
				GROUP_CONCAT(p.name,' * ',d.amount SEPARATOR '<br>') AS productDetail,
				o.orderNo,
				IF(o.who=1,'森大','碧海洋') who,
				u.unitName 
				FROM o_invoice i
				LEFT JOIN o_order o ON  o.id = i.orderId
				LEFT JOIN o_order_detail d ON d.orderId =  o.id  
				LEFT JOIN unit u ON o.unitId = u.id 
				LEFT JOIN product p ON d.productId = p.id
				GROUP BY i.id";
		$like_sql = $this->getLikeSql($search_key,"username","invoiceNo","money","who","orderNo","unitName");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY i.id desc"); 
		$this->search_key = $search_key;
        $this->pager = $model->spPager()->getPager();
        //echo($model->dumpSql());
        $this->display("o_invoice_index.htm"); // 显示模板
	}

	//显示打款表单
	function addform(){
		$o_order = spClass("o_order"); 
		$param = $this->spArgs();
		$conditions = array('id'=>$param['chk_list'][0]); 
		$this->order = $o_order->find($conditions); 
        $this->display("o_invoice_addform.htm"); // 显示模板
	}

	//显示打款表单
	function addsave(){
		$row = $this->spArgs();
		$o_invoice = spClass("o_invoice"); 
		$row["username"] = $_SESSION["username"];
        $o_invoice->create($row);
        $this->results = spUrl("o_order_action", "index"); ;
        $this->display("ok.htm"); // 显示模板
	}



	function deleteselect() {
		$o_order = spClass("o_invoice");
		$param = $this->spArgs();
		if (sizeof($param['chk_list']) > 0) {
			foreach ($param['chk_list'] as $id) {
				$o_order->deleteByPk($id);
			}
		}
		$this->results = spUrl("o_invoice_action", "index");
		;
		$this->display("ok.htm"); // 显示模板
	}
	function updatesave() {
		$o_order = spClass("o_order");
		$param = $this->spArgs();
		$conditions = array (
			'id' => $param['chk_list'][0]
		);
		$this->results = $o_order->find($conditions);
		$this->display("o_order_updateform.htm"); // 显示模板
	}



}