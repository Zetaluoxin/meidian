<?php 
namespace Admin\Controller;
use Admin\Controller;
/**
* ios遥控器
*/
class RemoteController extends CommonController
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	*ios遥控器
	*time:2017/2/7 17:00
	*auth:lxlxlx
	*/
	public function remote(){
		if(IS_POST){
			$data=I("post.data");
		}
		if(IS_GET){
			$data=I("get.data");
		}
		switch ($data) {
			case 'up':
				$this->getinfo(1,'上',$res);
				break;
			case 'down':
				$this->getinfo(1,'下',$res);
				break;
			case 'left':
				$this->getinfo(1,'左',$res);
				break;
			case 'right':
				$this->getinfo(1,'右',$res);
				break;
			case 'vol_up':
				$this->getinfo(1,'音量+',$res);
				break;
			case 'vol_down':
				$this->getinfo(1,'音量-',$res);
				break;
			case 'ok':
				$this->getinfo(1,'确认',$res);
				break;
			case 'back':
				$this->getinfo(1,'返回',$res);
				break;
			default:
				$this->getinfo(0,'没有');
				break;
		}
	}

}

 ?>