<?php 
namespace Admin\Logic;
use Think\Model;
/**
* 
*/
class CompanyLogic extends Model{
	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=M('Company');
	}

	/**
	*
	*@param 通过广告主（公司）id 查询名称
	*@return 
	*/
	public function getName($data){
		$res=$this->m->where($data)->select();
		return $res;
	}





	/**
	*添加广告主（公司）
	*@param $data
	*@return 成功返回插入成功的id
	*/

	public function addCom($data){
		$res=$this->m->add($data);
		// var_dump($res);
		return $res;
	}


	/**
	*通过$company_id查询广告主的联系方式
	*@param $company_id 广告主id
	*@return 
	*/

	public function getContact($com_id){
		$res=$this->where('id='.$com_id)->field('com_contact')->select();
		// dump($res);
		return $res[0];
	}



	/**
	*通过$company_id查询广告主的联系方式
	*@param $company_id 广告主id
	*@return 
	*/
	public function updateCompany($com_id,$data){
		$res=$this->m->where('id='.$com_id)->data($data)->save();
		return $res;
	}


}


	

 ?>