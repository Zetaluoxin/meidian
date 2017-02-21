<?php 
namespace Home\Logic;
use Think\Model;
/**
* User
*/
class UserLogic extends Model{


	protected $m;


	public function __construct(){
		parent::__construct();
		$this->m=M('user');

	}

	/**
	* 查询所有用户
	*@param 
	*@return 成功返回查询的详情
	*/

	public function getAllUser(){
		$res=$this->m->select();
		return $res;
	}

	//查询用户信息通过id或用户名
	function select_User($data){
		return $this->m->where($data)->select();
	}


	/**
	* 添加用户
	*@param $data 用户名 和 密码
	*@return 成功返回生成用户的id
	* 
	*/
	public function addUser($data){
		$res=$this->m->add($data);
		return $res;
	}




	/**
	* 给用户添加用户组
	*@param $user_id 用户名 $group_id 用户组id
	*@return 成功返回1（影响的条数） 失败返回0（false）
	* 
	*/
	public function addUserGroupByUserId($user_id,$group_id){
		$data=array();
		$data['group_id']=$group_id;
		$res=$this->m->where('id='.$user_id)->save($data);
		// dump($res);
		return $res;
	}





	/**
	* 给用户添加用户详情
	*@param $user_id  $data 用户详情
	*@return 成功返回影响的条数  失败返回0（false）
	* 
	*/
	public function addUserInfo($user_id,$data){
		$res=$this->m->where('id='.$user_id)->save($data);
		return $res;
	}




	public function belongTowhere($user_id){
		$res=$this->m->where('id='.$user_id)->find();
		$place=M('place')->where('id='.$res['place_id'])->select();
		// dump($place);
		return $place;
	}

	/**
	* 通过用户的id 查询名称
	*@param $user_id  
	*@return 成功返回用户的names 名称
	* 
	*/
	public function getUserName($user_id){
		$res=$this->m->where("id='%d'",$user_id)->Field('names')->find();
		return $res;
	}




}


 ?>