<?php  
	use \GatewayWorker\Lib\Db;
	class PetLogic{
		private $m;
		public function __construct(){
			$this->m = Db::instance('db1');
		}

		//查询宠物
		//string
		public function select_Pet($data=''){
			return $this->m->select('*')->from('xw_pet')->where($data)->query();
		}

		//修改宠物
		//  pet_id   int 
		// data array
		public function update_Pet($pet_id,$data){
			return $this->m->update('xw_pet')->cols($data)->where("id=?",$pet_id)->query();
		}
	}
?>