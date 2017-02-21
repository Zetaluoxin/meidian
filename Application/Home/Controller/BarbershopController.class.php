<?php 
namespace Home\Controller;
use Home\Controller\CommonController;
class BarbershopController extends CommonController{
	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=D('Barbershop','Logic');
	}

	

	/**
	*查询理发店名字
	*@param
	*@return
	*/
	public function queryBarbershop($user_id=''){
		if(IS_GET){
			$data['$user_id']=I('get.user_id');
		}
		if(IS_POST){
			$data['$user_id']=I('post.user_id');
		}
		$res=$this->m->queryBarbershop($data='');
		// dump($res);exit;
		if($res){
			$this->assign('barbershop',$res);
			// var_dump($res);
			return;
		}
		return false;
	}

}


 ?>