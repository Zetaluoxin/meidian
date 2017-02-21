<?php  
	namespace Home\Logic;
	use Think\Model;
	class OnlineLogic extends Model{
		private $m;
		function __construct(){
			parent::__construct();
			$this->m = M("Online");
		}


		//查询终端是否在线
		public function select_online($data){
			return $this->m->where($data)->select();
		}

		//新增在线终端
		public function insert_online($data){
			$n = $this->m->create($data);
			if($n){
				return $this->m->add($data);
			}
			return $n;
		}
		
	}
?>