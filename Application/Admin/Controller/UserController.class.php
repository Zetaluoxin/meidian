<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;
	/**
	* UserController
	*version v1.0
	*date 2016/12/15
	*auth:罗鑫
	*rebuild 2016/12/27
	*info:
	*.用户权限控制（用户权限删改查和用户权限自由分配功能）
	*/
class UserController extends CommonController{
	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=D('User','Logic');
	}

	public function index(){
		$this->display();
	}



	/**
	* 查询所有用户
	*@param $user_id 
	*@return 成功返回
	*修改时间:2017.1.1
	*  经过修改 可以取消此功能
	*/
	// public function getAllUser(){
	// 	$res=$this->m->getAllUser();
	// 	//查询结果
	// 	if($res){
	// 		// dump($this->getinfo(1,'success',$res));exit;
	// 		// print_r($res);
	// 		$this->assign("Userinfo",$res);
	// 		return ;
	// 	}
	// 	return false;
	// }


	/**
	* 查询用户
	*@param $user_id 
	*@return 成功返回
	* 
	*/
	function getUser(){
		if(IS_POST){
			I("post.user_id")?$data['id'] = I("post.user_id"):'';
			I("post.username")?$data['username'] = I("post.username"):'';
		}
		if(IS_GET){
			I("get.username")?$data['username'] = I("get.username"):'';
			I("get.telephonenum")?$data['telephonenum'] = I("get.telephonenum"):'';
			I("get.names")?$data['names'] = I("get.names"):'';
			I("get.shop_name")?$data['barbershop_name'] = I("get.shop_name"):'';
			I("get.company_name")?$data['company_name'] = I("get.company_name"):'';
		}
		if($data['barbershop_name']){
			$reg = D("Barbershop","Logic")->queryBarbershop(array("barbershop_name"=>$data['barbershop_name']));
			$res = array();
			foreach ($reg as $k => $v) {
				$shop['id'] = $v['user_id'];
				array_push($res, $this->m->select_User($shop)[0]);
			}
		}
		if($data['company_name']){
			$ret = D("Company","Logic")->getName(array("com_name"=>$data['company_name']));
			$res=array();
			foreach ($ret as $k => $v) {
				$com['id'] = $v['user_id'];
				array_push($res, $this->m->select_User($com)[0]);
			}
		}
		if(!$data['barbershop_name'] && !$data['company_name']){
			$res = $this->m->select_User($data);
		}
		if($res){
			$this->assign("user",$res);
			return;
		}
		return false;
	}




	/**
	* 添加用户用户
	*@param $username 用户名 $password 密码(采用md5码加密方式加密)
	*@return 成功返回创建成功的id($res) 失败则返回false
	* 
	*/
	public function addUser(){
		if(IS_POST){
			$data['username']=I('post.username');
			$data['password']=md5(I('post.password'));
		}
		if(IS_GET){
			$data['username']=I('get.username');
			$data['password']=md5(I('get.password'));
		}

		//合法验证验证
		if(trim($data['username']) && trim($data['password'])){
			$res=$this->m->addUser($data);
			$giveAuth = $this->m->giveAuth($res);
			if($res && $giveAuth){
				$this->getinfo(1,'添加成功',$res);
			}else{
				$this->getinfo(0,'帐号或者密码不能为空');
			}				
		}else{
			print('hehe who you are !this place is not belong to you !!!，就是这个坏人警察叔叔');die;
		}
		
	}






	/**
	* 给用户添加用户组
	*@param $user_id 用户名 $group_id
	*@return 成功返回1（影响的条数） 失败返回0（false）
	* 
	*/
	public function addUserGroupByUserId($user_id='',$group_id=''){
		if(IS_POST){
			$user_id=I('post.user_id');
			$group_id=I('post.group_id');
		}
		if(IS_GET){
			$user_id=I('get.user_id');
			$user_id=I('get.group_id');
		}
		// $user_id =2;
		// $group_id =1;
		$res=$this->m->addUserGroupByUserId($user_id,$group_id);
		//如果插入失败
		if($res == 0){
			return $this->getinfo(0,'添加失败','');
		}
		//如果查询成功
		if($res == 1){
			// dump($this->getinfo(1,'添加成功',$res));exit;
			return $this->getinfo(1,'添加成功',$res);
		}
	}






	/**
	* 通过用户的id（user_id）给指定的用户添加用户详情
	*@param $user_id $data
	*@return 成功返回1（影响的条数） 失败返回0（false）
	* 成功则为用户详情表(md_user_info)中添加用户详情
	*/
	public function addUserInfo($user_id='',$data=''){
		if(IS_POST){
			$user_id=I('post.user_id');
			$data['nickname']=I('post.nickname'); //昵称
			$data['names']=I('post.names');	//名字
			$data['qq']=I('post.qq');		//qq号
			$data['address']=I('post.address');	//地址
			$data['postalcode']=I('post.postalcode');//邮政编码
			$data['telephonenum']=I('post.telephonenum');//用户手机号码
			$data['image']=I('post.image');		//头像
		}
		if(IS_GET){
			$user_id=I('get.user_id');
			$data['nickname']=I('get.nickname'); //昵称
			$data['names']=I('get.names');	//名字
			$data['qq']=I('get.qq');		//qq号
			$data['address']=I('get.address');	//地址
			$data['postalcode']=I('get.postalcode');//邮政编码
			$data['telephonenum']=I('get.telephonenum');//用户手机号码
			$data['image']=I('get.image');		//头像
		}
		// $user_id=2;
		// $data['nickname']='小狐狸222';
		$res=$this->m->addUserInfo($user_id,$data);
		if($res ===1){
			return $this->getinfo(1,'添加成功',$res);
		}else{
			return $this->getinfo(0,'添加失败',$res);
		}
	}






	/**
	* 查询用户所属地区
	*@param $user_id 
	*@return 成功返回用户的
	* 
	*/
	public function belongTowhere($user_id=''){
		$user_id=1;
		$res=$this->m->belongTowhere($user_id);
		dump($res);
	}




	/**
	* 通过用户id查询用户名称
	*@param $user_id 
	*@return 成功返回用户的名称
	* 
	*/

	public function getUserName($user_id=''){
		if(IS_GET){
			$user_id=I('get.user_id');
		}
		if(IS_POST){
			$user_id=I('post.user_id');
		}
		// $user_id=1;
		$res=$this->m->getUserName($user_id);
		if($res){
			$this->getinfo(1,'查询成功',$res);
		}else{
			$this->getinfo(0,'查询失败');
		}
	}





	/**
	* 登录
	*@param $username $password
	*@return 成功返回：在session当中存入用户的信息（用户id
	 *当前用户名 上一次登录时间 上一次登录的ip）
	* 
	*/
	public function login(){
		$username=I('post.username');
		$password=md5(I('post.password'));
		$datauser['username']=$username;
		$datauser['password']=$password;
		// dump($datauser);
		$res=$this->m->login($datauser);
		// $passwordSql=md5($res[0]['password']);
		// dump($passwordSql);die();
		// dump($res);die;
		if($res && $res[0]['password']=$password && $res[0]['username']=$username){
			$uid=$res[0]['id'];
			$res1=$this->m->queryGroupByUid($uid);
			// dump($res1);die;
			// 将用户信息存入session
			session('uid', $res[0]['id']);          // 当前用户id
    		session('username', $res[0]['username']);   // 当前用户名
    		session('logintime', $res[0]['logintime']);   // 上一次登录时间
    		session('lastloginip', $res[0]['lastloginip']);       // 上一次登录ip
    		session('user_group',$res1);//将用户所属用户组存入session
    		 // 更新用户登录信息
 		$where['id'] = session('uid');
    		$data['logintime']=date('Y-m-d H:i:s');
    		$ip= get_client_ip();
    		$data['lastloginip']=$ip;
    		$result=$this->m->updateUserLoginInfo($data,$where);
    		//返回
    		if($result){
    			return $this->getinfo(1,'登录成功',$result);
    		}
    		return $this->getinfo(false,'登录失败');			
		}else{
			return $this->getinfo(false,'登录失败');
		}		
	}


	// /**
	// * 查询所有用户
	// *@param $user_id 
	// *@return 成功返回
	// * 
	// */
	// function getUser(){
	// 	if(IS_POST){
	// 		I("post.user_id")?$data['id'] = I("post.user_id"):'';
	// 		I("post.username")?$data['username'] = I("post.username"):'';
	// 	}
	// 	if(IS_GET){
	// 		I("post.user_id")?$data['id'] = I("post.user_id"):'';
	// 		I("post.username")?$data['username'] = I("post.username"):'';
	// 	}
	// 	$res = $this->m->select_User($data);
	// 	if($res){
	// 		$this->assign("user",$res);
	// 		return;
	// 	}
	// 	return false;
	// }


	/**
	* 删除用户（将帐号禁用）
	*@param $user_id 
	*@return
	* 
	*/
	public function delUser(){
		$data['user_status']=0;
		if(IS_GET){
			$user_id=I('get.user_id');
		}
		if(IS_POST){
			$user_id=I('post.user_id');
		}
		$res=$this->m->delUser($user_id,$data);
		if($res){
			return $this->getinfo(1,'禁用成功',$res);
		}else{
			return $this->getinfo(0,'禁用失败',$res);			
		}
	}





	/**
	* 启用被封用户（帐号解封）
	*@param $user_id 
	*@return
	* 
	*/
	public function reUser(){
		$data['user_status']=1;
		if(IS_GET){
			$user_id=I('get.user_id');
		}
		if(IS_POST){
			$user_id=I('post.user_id');
		}
		$res=$this->m->delUser($user_id,$data);
		if($res){
			return $this->getinfo(1,'解封成功',$res);
		}else{
			return $this->getinfo(0,'解封失败',$res);			
		}
	}





	/**
	* 退出登录
	*@param $user_id 
	*@return 清除session
	* 
	*/
	public function logout(){
		$res=session(null);
		if($res){
			return $this->getinfo(1,'退出成功',$res);
		}
		return $this->getinfo(1,'推出失败',$res); 
	}





	/**
	* 用户权限 增
	*@param $user_id
	*@return 
	*/
	public function authCreate(){
		if(IS_POST){
			$data['uid']=I('post.uid');
			$data['group_id']=I('post.group_id');			
		}
		if(IS_GET){
			$data['uid']=I('get.uid');
			$data['group_id']=I('get.group_id');			
		}
		$res=$this->m->authCreate($data);
		if($res){
			return $this->getinfo(1,'添加成功',$res);
		}else{
			return $this->getinfo(0,'添加失败',$res);
		}
	}


	/**
	* 用户权限 删
	*@param $user_id
	*@return 
	* 
	*/
	public function authDelete(){
		if(IS_POST){
			$uid=I('post.uid');			
		}
		if(IS_GET){
			$uid=I('get.uid');			
		}
		$data['status']=0;
		$res=$this->m->authDelete($data,$uid);
		if($res){
			return $this->getinfo(1,'删除成功',$res);
		}else{
			return $this->getinfo(0,'删除失败',$res);
		}
	}



	/**
	* 用户权限 改
	*@param $user_id
	*@return 
	*/
	public function authUpdate(){
		if(IS_POST){
			$data['uid']=I('post.uid');
			$data['group_id']=I('post.group_id');
			$uid=I('post.uid');		
		}
		if(IS_GET){
			$data['uid']=I('get.uid');
			$data['group_id']=I('get.group_id');
			$uid=I('get.uid');			
		}
		$array['status']=0;
		$res=$this->m->authDelete($uid,$data,$array);
		if($res){
			return $this->getinfo(1,'更改成功',$res);
		}else{
			return false;
		}
	}

	/**
	* 用户权限自由分配
	*@param $uid
	*@return 
	*/
	public function authUpdateFree(){
		if(IS_POST){
			$uid=I('post.uid');
			$data['rules']=I('post.rules');
		}
		if(IS_GET){
			$uid=I('get.uid');
			$data['rules']=I('get.rules');
		}
		$result=$this->m->deleteAGA($uid);
		// dump($result);die;
		if($result){
			$res=$this->m->authUpdateFree($uid,$data);
			if($res){
				return $this->getinfo(1,'success',$res);
			}else{
				return $this->getinfo(0,'faild',$res);
			}
		}
		return $this->getinfo(0,'faild',$result);
	}


	/**
	* 用户权限 查
	*@param $user_id
	*@return 
	*/
	public function authQuery(){
		if(IS_POST){
			$uid=I('post.uid');			
		}
		if(IS_GET){
			$uid=I('get.uid');			
		}
		// dump($uid);die;
		$res=$this->m->authQuery($uid);
		// dump($res);die;
		if($res){
			return $this->getinfo(1,'yes',$res);
		}else{
			return $this->getinfo(0,'no',$res);
		}
		
	}





	/**
	*用户修改用户详情
	*date:2016/12/30 14:15
	*auth:罗鑫
	*@param $uid 登录用户在session中存入的id $data(names,nicknames,qq,phone)用户修改的用户详情内容 如果没有 将不会放入$data中
	*@return 成功返回：status:1 '修改成功' $res 
	*	   失败返回：status:0
	*/
	public function updateUserInfo(){
		$uid=session('uid');
		if(IS_POST){
			I('post.names')?$data['names']=I('post.names'):'';
			I('post.nicknames')?$data['nickname']=I('post.nicknames'):'';
			I('post.qq')?$data['qq']=I('post.qq'):'';
			I('post.phone')?$data['telephonenum']=I('post.phone'):'';
		} 
		// dump($data);exit;
		$res=$this->m->updateUserInfo($uid,$data);
		if($res){
			// $this->logout();
			return $this->getinfo(1,'修改陈功',$res);
		}else{
			return $this->getinfo(0,'修改失败',$res);
		}
	}



	/**
	*用户修改密码
	*date:2017/1/3 9:30
	*auth:罗鑫
	*@param $uid $oldpassword $newpassword $repeatnewpassword
	*@return
	*/
	public function updateUserPassword(){
		$uid=session('uid');
		if(IS_POST){
			I('post.oldpassword')?$password=I('post.oldpassword'):'';
			I('post.newpassword')?$newpassword=I('post.newpassword'):'';
			I('post.repeatnewpassword')?$repeatnewpassword=I('post.repeatnewpassword'):'';
		}
		if($newpassword != $repeatnewpassword){
			return getinfo(3,'两次输入的密码不一致');
		}
		$data['id']=$uid;
		$res=$this->m->select_User($data);
		// dump($res);die;
		$oldpassword=md5($password);
		if( $res[0][password] != $oldpassword ){
			return $this->getinfo(4,'请输入正确的原密码');
		}
		$data1['password']=md5($newpassword);
		$res1=$this->m->updateUserPassword($data,$data1);
		if($res1){
			return $this->getinfo(1,'修改成功',$res);
		}else{
			return $this->getinfo(0,'修改失败',$res);
		}

	}



}


	


 ?>