<?php 

namespace Home\Logic;
use Think\Model;
/**
* 
*/
class BarbershopLogic extends Model{

	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=M('barbershop');

	}



	/**
	*添加理发店详情
	*@param $data  （理发店详情）
	*@return
	*
	*/
	public function queryBarbershop($data=''){
		$res=$this->m->where($data)->select();
		return $res;
	}




	/**
	*添加理发店详情
	*@param $data  （理发店详情）
	*@return
	*
	*/
	public function addBarbershop($data){
		$res=$this->m->add($data);
		return $res;
	}



}
 ?>