<?php  
	use \GatewayWorker\Lib\Db;
	class PlaceLogic{
		private $m;
		public function __construct(){
			$this->m = Db::instance('db1');
		}

		//查询土地
		public function select_Place($data=''){
			return $this->m->select("*")->from('xw_place')->where($data)->query();
		}

		//修改土地
		public function update_Place($place_id,$data){
			return $this->m->update('xw_place')->cols($data)->where("id=?",$place_id)->query();
		}
	}
?>