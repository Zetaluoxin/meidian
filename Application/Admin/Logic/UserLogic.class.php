<?php 
namespace Admin\Logic;
use Think\Model;
/**
* User
*/
class UserLogic extends Model{

	Protected $autoCheckFields = false;
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



	/**
	* 用户登录
	*@param $username $password
	*@return 查询成功返回查询到的用户的信息
	* 
	*/
	public function login($datauser){
		// $data['username']=$username;
		// dump($datauser);
		// $AGA=M('auth_group_access');
		$res=$this->m->where($datauser)->select();
		// dump($res);die;
		// $res1=$AGA->where('uid='.$res[0]['id'])->select(); //查询用户所在用户组的id
		// $res['group_id']=$res1[0]['group_id']; //将查询到的用户组id放入返回结果集
		return $res;
	}


	/**
	* 用户登录信息更新
	*@param $data (用户登录的时间 用户登录的ip)
	*@return 更新用户最后登录的时间 和最后登录的ip
	* 
	*/
	public function updateUserLoginInfo($data,$where){
		return $this->m->where("id='%d'",$where)->save($data);
	}


	// //查询用户信息通过id或用户名
	// function select_User($data){
	// 	return $this->m->where($data)->select();
	// }



	/**
	* 删除用户（将帐号禁用）
	*@param $user_id 
	*@return
	* 
	*/
	public function delUser($user_id,$data){
		return $this->m->where('id='.$user_id)->data($data)->save();
	}



	/**
	* 用户权限 增
	*@param $user_id
	*@return 
	*/
	public function authCreate($data){
		$PGA=M('auth_group_access');
		return $PGA->create($data);
	}

	/**
	* 用户权限 删
	*@param $user_id
	*@return 
	*/
	public function authDelete($data,$uid){
		$PGA=M('auth_group_access');
		return $PGA->where('uid='.$uid)->save($data);
	}


	/**
	* 用户权限 改
	*@param $user_id
	*@return 
	*/
	public function authUpdate($uid,$data,$array){
		$PGA=M('auth_group_access');
		$PGA->startTrans();
		$res1=$PGA->where('uid='.$uid)->save($array);
		$res2=$PGA->create($data);
		if($res1 && $res2){
			$PGA->commit();
			return $res2;
		}else{
			$PGA->rollback();
			return false;
		}
	}



	/**
	* 用户权限自由分配
	*@param $uid
	*@return 
	*/
	public function deleteAGA($uid){
		$AGA=M('auth_group_access');
		$res=$AGA->where('uid='.$uid)->delete();
		return $res;
	}


	public function authUpdateFree($uid,$data){
		$AGA=M('auth_group_access');
		$AG=M('auth_group');
		$data['uid']=$uid;
		$data['$data']=$data;
		$res=$AG->data($data)->add();
		if($res){
			$haha=array();
			$haha['group_id']=$res;
			$haha['uid']=$uid;
			$res1=$AGA->data($haha)->add();
			return $res1;
		}
		return false;






		
		// $AG=M('auth_group');
		// $data['title']=$uid;
		// $AGA->startTrans();
		// $haha['status']=0;
		// $res=$AG->where('title='.$uid)->save($haha);	//如果有自由分配权限的用户组表则讲此表改为不可用
		// $group_id=$AG->add($data);  //新建用户组 返回$group_id
		// $res1=$AGA->where('uid='.$uid)->save($data);	//将原有的用户组明细表改为不可用
		// $array=array(
		// 	'uid'=>$uid,
		// 	'group_id'=>$group_id
		// 	);
		// $res2=$AGA->add($array);		//新建用户组明细表
		// if($res && $re1 && $res2 && $group_id){
		// 	$AGA->commit();
		// 	return $res;
		// }
		// 	$AGA->rollback();
		// 	return false;
	}


	/**
	* 用户权限 查
	*@param $user_id
	*@return 
	*/
	public function authQuery($uid){
		$AGA=M('auth_group_access');
		$res=$AGA->where('uid='.$uid)->select();
		// dump($res[0]);die;	
		if($res){
			$AG=M('auth_group');
			$res1=$AG->where('id='.$res[0]['group_id'])->select();
			// dump($res1);die;
			return $res1;
		}
		return false;





		// $PGA=M('auth_group_access');
		// $res=$PGA->where('uid='.$uid)->select();
		// $AG=M('auth_group');
		// $res1=$AG->where('id='.$res[0]['group_id'])->select();
		// $array=explode(",",$res1);
		// $AR=M('auth_rule');
		// for($i=0;$i<count($array);$i++) {
		// 	$res2[$i]=$AR->where('id='.$array[$i])->select();
		// }
		// return $res2;
	}

	/**
	* 用户组查询  通过uid
	*@param $user_id
	*@return 
	*/
	public function queryGroupByUid($uid){
		$AGA=M('auth_group_access');
		$res=$AGA->where('uid='.$uid)->select();
		return $res[0]['group_id'];
	}



	/**
	*date:2016/12/30 14:15
	*auth:罗鑫
	*@param $uid 登录用户在session中存入的id $data(names,nicknames,qq,phone)用户修改的用户详情内容 如果没有 将不会放入$data中
	*@return 成功返回：status:1 '修改成功' $res 
	*	   失败返回：status:0
	*/
	public function updateUserInfo($uid,$data){
		// dump($uid);
		// dump($data);exit;
		$res=$this->m->where('id='.$uid)->data($data)->save();
		return $res;
	}
	/**
	*date:2017/1/1 11:20
	*auth:罗鑫
	*@param $uid
	*@return
	*/
	public function updateUserPassword($data,$data1){
		$res=$this->m->where($data)->save($data1);
		return $res;
	}
	/**
	*date:2017/2/16 10:02
	*auth:罗鑫
	*@param $uid
	*@return
	*/
	public function giveAuth($res){
		$AG = M("auth_group");
		$AGA = M("auth_group_access");
		$rules = array(
			"rules"=> '1'
			);
		$res_AG = $AG->data($rules)->add();
		$data = array(
			"uid"=>$res,
			"group_id"=>$res_AG
			);
		$res_AGA = $AGA->data($data)->add();
		if($res_AGA){
			return true;
		}
	}
}


 ?>