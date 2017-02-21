<?php 
namespace Home\Controller;
use Home\Controller\CommonController;
	/**
	* 终端控制器
	*版本 1.0
	*作者:罗鑫
	*/
class ProductController extends CommonController{
	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=D('Product','Logic');
	}
	




	/**
	* 查询终端
	*@param
	*@return
	*作者:罗鑫
	*/
	public function getProduct($barbershop_id='',$product_type='',$product_maccode='',$product_batch='',$product_status='',$product_fix=''){
		if(IS_GET){
			$data['barbershop_id']=I('get.barbershop_id'); 	//终端所在店铺id
			$data['product_type']=I('get.product_type');		//机型
			$data['product_maccode']=I('get.product_maccode');//mac码	
			$data['product_batch']=I('get.product_batch');	//终端编号
			$data['product_status']=I('get.product_status');	//运行状态
			$data['product_fix']=I('get.product_fix');		//报修状态
		}
		if(IS_POST){
			$data['barbershop_id']=I('post.barbershop_id');
			$data['product_type']=I('post.product_type');
			$data['product_maccode']=I('post.product_maccode');
			$data['product_batch']=I('post.product_batch');
			$data['product_status']=I('get.product_status');
			$data['product_fix']=I('get.product_fix');
		}
		// print('我进来拉');
		$res=$this->m->getProduct();
		// dump($res);exit();
		if($res){
			// var_dump($res);
			$this->assign('product',$res);
			return;
		}
		return false;
	}


	/**
	* 判断终端状态信息
	*@param
	*@return
	*作者:杜勇
	*/
	public function getStatus(){
		if(IS_POST){
			$data['id'] = I("post.product_id");
		}
		if(IS_GET){
			$data['id'] = I("get.product_id");
		}
		$res = $this->m->getProduct($data);
		$res?$this->getinfo(true,"",$res):$this->getinfo(false,"",$res);
	}

}



 ?>