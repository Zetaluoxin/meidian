<?php  
	use \GatewayWorker\Lib\Db;
	class EventLogic{
		private $m;
		public function __construct(){
			$this->m = Db::instance('db1');
		}

		//新增事件
		public function insert_Event($data){
			return $this->m->insert('xw_place_event')->cols($data)->query();
		}
		//查询事件详细
		public function select_Event($data=''){
			return $this->m->select("*")->from("xw_event")->where($data)->query();
		}

		//查询土地事件中间表
		public function select_Place_Event($data=''){
			return $this->m->select("*")->from("xw_place_event")->where($data)->query();
		}

		//修改事件
		public function update_Event($data){
			return $this->m->update("xw_place_event")->cols(array('end_time'=>date("Y-m-d H:i:s")))->where($data)->query();
		}
	}
?>