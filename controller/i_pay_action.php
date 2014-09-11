<?php
class i_pay_action extends spController {

	function index() {
		$model = spClass("product");
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "SELECT pay.id,o.orderNo,pay.money,pay.payTime,u.unitName,IF(o.who=1,'森大','碧海洋') who,pay.username,pay.updateTime,pay.remark FROM i_pay pay LEFT JOIN i_order o ON pay.orderId = o.id LEFT JOIN unit u ON o.unitId = u.id";
		$like_sql = $this->getLikeSql($search_key, "orderNo", "money", "payTime", "who", "unitName");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql . $like_sql . " ORDER BY pay.id desc");
		$this->search_key = $search_key;
		$this->pager = $model->spPager()->getPager();
		//echo($model->dumpSql());
		$this->display("i_pay_index.htm"); // 显示模板
	}

	//显示打款表单
	function addform() {
		$i_order = spClass("i_order");
		$param = $this->spArgs();
		$conditions = array (
			'id' => $param['chk_list'][0]
		);
		$this->order = $i_order->find($conditions);
		$this->display("i_pay_addform.htm"); // 显示模板
	}

	//显示打款表单
	function addsave() {
		$row = $this->spArgs();
		$i_pay = spClass("i_pay");
		$row["username"] = $_SESSION["username"];
		$i_pay->create($row);
		$this->results = spUrl("i_order_action", "index");
		;
		$this->display("ok.htm"); // 显示模板
	}

	function deleteselect() {
		$i_order = spClass("i_pay");
		$param = $this->spArgs();
		if (sizeof($param['chk_list']) > 0) {
			foreach ($param['chk_list'] as $id) {
				$i_order->deleteByPk($id);
			}
		}
		$this->results = spUrl("i_pay_action", "index");
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