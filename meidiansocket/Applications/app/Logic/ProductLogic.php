<?php  
	use \GatewayWorker\Lib\Db;
	class ProductLogic{
		private $m;
		public function __construct(){
			$this->m = Db::instance('db1');
		}
		
		//修改终端信息
		public function update_Product($data,$mac){
			return $this->m->update('md_product')->cols($data)->where("product_maccode='?'",$mac)->query();
		}
	}
?>