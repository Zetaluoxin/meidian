<?php 
namespace Admin\Logic;
use Think\Model;
/**
* 
*/
class AuthLogic extends Model
{
	protected $m;
	function __construct()
	{
		# code...
		parent::__construct();
		$this->m=M('auth_group');
	}
	/**
	* 创建用户组
	*@param
	*@return 
	*/	
	public function authGrupCreate($data){
		return $res=$this->m->create($data);
	}


	/**
	* 删除用户用户组
	*@param
	*@return 
	*/	
	public function authGrupUpdate($data){
		return $res=$this->m->where("id='%d'",$data)->save('status='.'0');
	}



	/**
	* 更改用户用户组
	*@param
	*@return 
	*/	
	public function authGrupUpdate($id,$data){
		return $res=$this->m->where('id='.$id)->save($data);
	}


	/**
	* 查询用户组
	*@param
	*@return 
	*/
	public function authGrupUpdate($data){
		return $res=$this->m->where($data)->select();
	}
}


 ?>