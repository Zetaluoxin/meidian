<?php 
namespace Home\Controller;
use Home\Controller\CommonController;
	/**
	* 用户控制器
	*版本 1.0
	*作者:罗鑫
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
	* 
	*/
	public function getAllUser(){
		$res=$this->m->getAllUser();
		//查询结果
		if($res){
			// dump($this->getinfo(1,'success',$res));exit;
			// print_r($res);
			$this->assign("Userinfo",$res);
			return ;
		}
		return false;
	}


	/**
	* 查询所有用户
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
			I("post.user_id")?$data['id'] = I("post.user_id"):'';
			I("post.username")?$data['username'] = I("post.username"):'';
		}
		$res = $this->m->select_User($data);
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
		// print(md5($password));
		// print_r($data);
		//合法验证验证
		// $username='xxxx';
		// $password=md5('lxlxlx');
		// $data['username']=$username;
		// $data['password']=$password;
		trim($username);
		trim($password);
		$res=$this->m->addUser($data);
		if($res){
			$this->getinfo(1,'添加成功',$res);
		}else{
			$this->getinfo(0,'帐号或者密码不能为空');
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
	* 查询用户的权限
	*@param $user_id
	*@return 成功返回1（影响的条数） 失败返回0（false）
	* 成功则为用户详情表(md_user_info)中添加用户详情
	*/
	public function getUserAuth($user_id=''){
		$user_id=session('user_id');
		$res=$this->m->getUserAuth($user_id);
		if($res){
			return $this->getinfo(1,'查询成功',$res);
		}else{
			return $this->getinfo(0,'查询失败');
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
	
}



 ?>