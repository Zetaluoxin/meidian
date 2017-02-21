<?php  
	use \GatewayWorker\Lib\Db;
	class OnlineLogic{
		private $m;
		public function __construct(){
			$this->m = Db::instance('db1');
		}
		
		//查询在线终端信息
		public function getOnline($client_id){
			return $this->m->select('*')->from('md_online')->where('client_id=?',$client_id)->query();
		}

		//删除离线终端
		public function del_outline($mac){
			return $this->m->delete('md_online')->where('mac=?',$mac)->query();
		}
	}
?>
