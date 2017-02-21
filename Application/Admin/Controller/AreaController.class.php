<?php 	
namespace Admin\Controller;
use Admin\Controller\CommonController;
/**
* 
*/
class AreaController extends CommonController {
	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=D('Area','Logic');
	}
	public function queryArea(){
		if(IS_POST){
			$data = I("post.advert_id");
		}
		if(IS_GET){
			$data = I("get.advert_id");
		}
		$data['advert_id']=1;
		$res=$this->m->queryArea($data);
		if($res){
			$this->assign("area",$res);
			return;
		}else{
			return false;
		}
	}
}








?>