<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;
/**luoxin
* 2016/12/26
*1.0
*/
class AuthController extends CommonController
{
	protected $m;
	function __construct()
	{
		parent::__construct;
		$this->m=D('Auth','Logic');
	}

	/**
	*用户注册应该自动进入公共权限用户组
	*默认的 公共权限用户组的权限应该包含：
	*
	*/




	/**
	* 创建用户组
	*@param
	*@return 
	*/	
	public function authGrupCreate(){
		if(IS_POST){
			$data['rules']=I('post.rules');
			$data['title']=I('post.title');
			$data['rules']=I('post.rules');
		}
		// if(IS_GET){
		// 	$data['rules']=I('get.rules');
		// 	$data['title']=I('get.title');
		// 	$data['rules']=I('get.rules');
		// }
		$res=$this->m->authGrupCreate($data);
		if($res){
			return $this->getinfo(1,'创建成功',$res);
		}else{
			return $this->getinfo(0,'创建失败',$res);			
		}
	}






	/**
	* 删除用户用户组
	*@param
	*@return 
	*/	
	public function authGrupUpdate(){
		if(IS_POST){
			$data['id']=I('post.id');
		}
		// if(IS_GET){
		// 	$data['id']=I('get.id');
		// }
		$res=$this->m->authGrupUpdate($data)
		if($res){
			return $this->getinfo(1,'删除成功',$res);
		}else{
			return $this->getinfo(0,'删除失败',$res);			
		}
	}






	/**
	* 更改用户用户组
	*@param
	*@return 
	*/	
	public function authGrupUpdate(){
		if(IS_POST){
			$id=I('post.id');
			$data['title']=I('post.title');
			$data['rules']=I('post.rules');
		}
		// if(IS_GET){
		// 	$id=I('get.id');
		// 	$data['title']=I('get.title');
		// 	$data['rules']=I('get.rules');
		// }
		$res=$this->m->authGrupUpdate($id,$data)
		if($res){
			return $this->getinfo(1,'更改成功',$res);
		}else{
			return $this->getinfo(0,'更改失败',$res);			
		}
	}






	/**
	* 查询用户用户组
	*@param
	*@return 
	*/	
	public function authGrupUpdate(){
		if(IS_POST){
			$data['id']=I('post.id');
		}
		// if(IS_GET){
		// 	$data['id']=I('get.id');
		// }
		$res=$this->m->authGrupUpdate($data)
		if($res){
			return $this->assign('authGrup',$res);
		}
		return false;
	}
}



 ?>