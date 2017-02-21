<?php 
namespace Home\Controller;
use Home\Controller\CommonController;
/**
* 
*/
class CompanyController extends CommonController{
	protected $m;
	function __construct(){
		parent::__construct();
		$this->m=D('Company','Logic');
	}

	/**
	*通过$company_id查询广告主的名字
	*@param $company_id 广告主id
	*@return 
	*/
	public function getName($company_id=''){
		if(IS_GET){
			$data['company_id']=I('get.company_id');
		}
		if(IS_POST){
			$data['company_id']=I('post.company_id');
		}
		// $data['company_id']=1;
		$res=$this->m->getName($data);
		if($res){
			// dump($res);exit;
			$this->assign('company',$res);
			return;
		}
		return false;
	}






	/**
	*添加广告主（公司）
	*@param $com_name $com_contact $com_logo_big $com_logo_small
	*@return 成功返回插入成功的id
	*/
	public function addCom($com_name='',$com_contact=''){
		if(IS_POST){
			$data['com_name']=I('post.com_name');
			$data['com_contact']=I('post.com_contact');
		}
		if(IS_GET){
			$data['com_name']=I('get.com_name');
			$data['com_contact']=I('get.com_contact');
		}
		// $data['com_name']='王克林';
		// $data['com_contact']='100101010101010';
		// $data['com_logo_big']='sfiojdsjfdsjfksjfjdsjfsd';
		// $data['com_logo_small']='saodfjkasdjfksdajfksd';
		$res=$this->m->addCom($data);
		// print($res);exit;
		if($res){
			return $this->getinfo(1,'添加成功',$res);
		}else{
			return $this->getinfo(0,'添加失败');
		}
	}



	/**
	*通过$company_id查询广告主的联系方式
	*@param $company_id 广告主id
	*@return 
	*/


	public function getContact($com_id=''){
		if(IS_GET){
			$com_id=I('get.company_id');
		}
		if(IS_POST){
			$com_id=I('post.company_id');
		}
		// $com_id=2;
		$res=$this->m->getContact($com_id);
		if($res){
			// dump($res);exit;
			$this->assign('companyContact',$res);
			return;
		}
		return false;
	}

}











 ?>