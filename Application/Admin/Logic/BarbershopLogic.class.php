<?php 

namespace Admin\Logic;
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
	*创建理发店
	*@param $data  
	*@return
	*
	*/
	public function addBarbershop($data){
		$res=$this->m->add($data);
		return $res;
	}





	/**
	*添加理发店详情
	*@param $data  （理发店详情）
	*@return
	*
	*/
	public function queryBarbershop($data){
		$res=$this->m->where($data)->select();
		return $res;
	}





	/**
	*修改理发店信息
	*@param
	*@return
	*/
	public function updateBarbershop($barbershop_id,$data){
		$res=$this->m->where("id=".$barbershop_id)->data($data)->save();
		return $res;
	}





	/**
	*理发店数量统计  地区（省，市，区，街道）
	*@param $data 地区（省，市，区，街道）的id
	*@return
	*/	
	public function babershopStatistics($data){
		$res=$this->m->where($data)->select();
		return count($res);
	}





	/**
	*查询理发店  通过街道
	*@param
	*@return
	*/
	public function queryBarbershopByStreet($data){
		$res=$this->m->where($data)->select();
		return $res;
	}


	public function provinceId($user_id){
		$PA=I('province_agent');
		// dump('haha ');die;
		$res=$PA->where('uid='.$user_id)->select();
		return $res[0]['province_id'];
	}
	public function cityId($user_id){
		$CA=I('city_agent');
		dump('haha ');
		$res=$CA->where('uid='.$user_id)->select();
		return $res[0]['city_id'];
	}
}
 ?>