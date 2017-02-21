<?php
	namespace Home\Controller;
	use Home\Controller\CommonController;
	use GatewayClient\Gateway;
	class IndexController extends CommonController{
		public function __construct(){
			parent::__construct();
		}

		public function client(){
			if(IS_POST){
	    		$client_id = I("post.client_id");
	    		$mac = I("post.mac");
			}
			if(IS_GET){
	    		$client_id = I("get.client_id");
	    		$mac = I("get.mac");
			}
			Gateway::bindUid($client_id,$mac);
			$data['product_status'] = 1;
			$online = D("Online",'Logic');
			$arr = array(
				'mac'=>$mac,
				'client_id'=>$client_id,
				'start_time'=>date("Y-m-d H:i:s")
			);
			$ret = $online->select_online(array('mac'=>$mac));
			M("")->startTrans();
			try{
				$res = $this->is_online($mac,$data);
				if(!$ret){
					$reg = $online->insert_online($arr);
				}
			}catch(Exception $e){
				M("")->rollback();
				return $this->getinfo(0,'绑定失败,事物回滚');
			}
			M("")->commit();
	    	$res&&$reg?$this->getinfo(1,'绑定成功',$res):$this->getinfo(0,'绑定失败',$res);
	    }

		//测试遥控器
	    public function remote(){
	    	if(IS_POST){
	    		$data = I("post.data");
	    		$client_id = I("post.client_id");
	    		$mac = I("post.mac");
	    	}
	    	if(IS_GET){
	    		$data = I("get.data");
	    		$client_id = I("get.client_id");
	    		$mac = I("get.mac");
	    	}
	    	$message = array(
				'type'=>'remote',
				'direction'=>$data
			);
			Gateway::sendToUid($mac,json_encode($message));
	    	switch ($data) {
	    		case 'left':
	    			$this->getinfo(1,'报告:收到向左的命令!');
	    			break;
	    		case 'right':
	    			$this->getinfo(1,'报告:收到向右的命令!');
	    			break;
	    		case 'up':
	    			$this->getinfo(1,'报告:收到向上的命令!');
	    			break;
	    		case 'down':
	    			$this->getinfo(1,'报告:收到向下的命令!');
	    			break;
	    		case 'vol_up':
	    			$this->getinfo(1,'报告:收到加音量的命令!');
	    			break;
	    		case 'vol_donw':
	    			$this->getinfo(1,'报告:收到减音量的命令!');
	    			break;
	    		case 'ok':
	    			$this->getinfo(1,'报告:收到确认的命令!');
	    			break;
	    		case 'back':
	    			$this->getinfo(1,'报告:收到返回的命令!');
	    			break;
	    		default:
	    			$this->getinfo(0,'别闹!');
	    			break;
	    	}

	    }
	}
?>