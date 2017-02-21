<?php 
	namespace Admin\Controller;
	use Admin\Controller\CommonController;
	use GatewayClient\Gateway;

	/**
	* 终端在线
	*auth :lxlxlx
	*time 2017/2/9 10:58
	*/
	class OnlineController extends CommonController
	{
		public function __construct()
		{
			# code...
			parent::__construct();
			Gateway::$registerAddress = '127.0.0.1:1234';
		}


		public function isOnline(){
			if(IS_POST){
				$mac = I("post.product_maccode");
			}
			if(IS_GET){
				$mac = I("get.product_maccode");
			}
			$res= Gateway::isUidOnline($mac);
			if($res){
				return $this->getinfo(1,'online',$res);
			}else{
				return $this->getinfo(0,'offline',$res);
			}
		}



		public function isOnlineHa($product_maccode=''){
			$product_maccode?$mac = $product_maccode:'';
			$res= Gateway::isUidOnline($mac);
			return $res;
		}




		public function getAllOnline(){			
			$res= Gateway::getAllClientCount();
			if($res){
				return $this->getinfo(1,'number',$res);
			}else{
				return $this->getinfo(0,'error',$res);
			}
		}

	}
 ?>