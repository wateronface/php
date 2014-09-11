<?php
class i_invoice_action extends spController
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
				FROM i_invoice i
				LEFT JOIN i_order o ON  o.id = i.orderId
				LEFT JOIN i_order_detail d ON d.orderId =  o.id  
				LEFT JOIN unit u ON o.unitId = u.id 
				LEFT JOIN product p ON d.productId = p.id
				GROUP BY i.id";
		$like_sql = $this->getLikeSql($search_key,"username","invoiceNo","money","who","orderNo","unitName");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql.$like_sql." ORDER BY i.id desc"); 
		$this->search_key = $search_key;
        $this->pager = $model->spPager()->getPager();
        //echo($model->dumpSql());
        $this->display("i_invoice_index.htm"); // 显示模板
	}

	//显示打款表单
	function addform(){
		$i_order = spClass("i_order"); 
		$param = $this->spArgs();
		$conditions = array('id'=>$param['chk_list'][0]); 
		$this->order = $i_order->find($conditions); 
        $this->display("i_invoice_addform.htm"); // 显示模板
	}

	//显示打款表单
	function addsave(){
		$row = $this->spArgs();
		$i_invoice = spClass("i_invoice"); 
		$row["username"] = $_SESSION["username"];
        $i_invoice->create($row);
        $this->results = spUrl("i_order_action", "index"); ;
        $this->display("ok.htm"); // 显示模板
	}



	function deleteselect() {
		$i_order = spClass("i_invoice");
		$param = $this->spArgs();
		if (sizeof($param['chk_list']) > 0) {
			foreach ($param['chk_list'] as $id) {
				$i_order->deleteByPk($id);
			}
		}
		$this->results = spUrl("i_invoice_action", "index");
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