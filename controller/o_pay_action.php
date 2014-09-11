<?php
class o_pay_action extends spController {

	function index() {
		$model = spClass("product");
		$search_key = $this->spArgs('search_key', null);
		$base_sql = "SELECT pay.id,o.orderNo,pay.money,pay.payTime,u.unitName,IF(o.who=1,'森大','碧海洋') who,pay.username,pay.updateTime,pay.remark FROM o_pay pay LEFT JOIN o_order o ON pay.orderId = o.id LEFT JOIN unit u ON o.unitId = u.id";
		$like_sql = $this->getLikeSql($search_key, "orderNo", "money", "payTime", "who", "unitName");
		$this->results = $model->spPager($this->spArgs('page', 1), PAGE_SIZE)->findSql($base_sql . $like_sql . " ORDER BY pay.id desc");
		$this->search_key = $search_key;
		$this->pager = $model->spPager()->getPager();
		//echo($model->dumpSql());
		$this->display("o_pay_index.htm"); // 显示模板
	}

	//显示打款表单
	function addform() {
		$o_order = spClass("o_order");
		$param = $this->spArgs();
		$conditions = array (
			'id' => $param['chk_list'][0]
		);
		$this->order = $o_order->find($conditions);
		$this->display("o_pay_addform.htm"); // 显示模板
	}

	//显示打款表单
	function addsave() {
		$row = $this->spArgs();
		$o_pay = spClass("o_pay");
		$row["username"] = $_SESSION["username"];
		$o_pay->create($row);
		$this->results = spUrl("o_order_action", "index");
		;
		$this->display("ok.htm"); // 显示模板
	}

	function deleteselect() {
		$o_order = spClass("o_pay");
		$param = $this->spArgs();
		if (sizeof($param['chk_list']) > 0) {
			foreach ($param['chk_list'] as $id) {
				$o_order->deleteByPk($id);
			}
		}
		$this->results = spUrl("o_pay_action", "index");
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