<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;
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
			I('get.com_name')?$data['com_name']=I('get.com_name'):'';
			I('get.place')?$data['place']=I('get.place'):'';
			I('get.user_id')?$data['user_id']=I('get.user_id'):'';
		}
		if(IS_POST){
			$data['company_id']=I('post.company_id');
		}
		if($data['user_id']){
			$data['user_id'] = D("User","Logic")->select_User(array("names"=>$data['user_id']))[0]['id'];
		}
		if($data['place']){
			$data['province_id'] = D("Place","Logic")->queryProvinceById(array('province_name'=>$data['place']))[0]['id'];
		}
		// var_dump($data);
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
			I('post.com_name')?$data['com_name']=I('post.com_name'):'';
			I("post.user_id")?$data['user_id'] = I("post.user_id"):'';
			I("post.province_id")?$data['province_id'] = I("post.province_id"):'';
			I("post.city_id")?$data['city_id'] = I("post.city_id"):'';
			I("post.district_id")?$data['district_id'] = I("post.district_id"):'';
			I("post.street_id")?$data['street_id'] = I("post.street_id"):'';
			I("post.barbershop_id")?$data['barbershop_id'] = I("post.barbershop_id"):'';
		}
		// if(IS_GET){
		// 	I('get.com_name')?$data['com_name']=I('get.com_name'):'';
		// 	I("get.user_id")?$data['user_id'] = I("get.user_id"):'';
		// 	I("get.province_id")?$data['province_id'] = I("get.province_id"):'';
		// 	I("get.city_id")?$data['city_id'] = I("get.city_id"):'';
		// 	I("get.district_id")?$data['district_id'] = I("get.district_id"):'';
		// 	I("get.street_id")?$data['street_id'] = I("get.street_id"):'';
		// 	I("get.barbershop_id")?$data['barbershop_id'] = I("get.barbershop_id"):'';
		// }
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
			I('get.company_id')?$com_id=I('get.company_id'):'';
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


	/**
	*修改
	*@param $company_id 广告主id
	*@return 
	*/
	public function updateCompany(){
		// if(IS_GET){
		// 	$com_id=I('get.company_id');
		// 	$data['com_name']=I('get.com_name');		
		// 	$data['user_id']=I('get.user_id');	
		// 	$data['com_logo_big']=I('get.com_logo_big');			
		// 	$data['com_logo_small']=I('get.com_logo_small');	
		// 	$data['province_id'] = I("get.province_id");
		// 	$data['city_id'] = I("get.city_id");
		// 	$data['district_id'] = I("get.district_id");
		// 	$data['street_id'] = I("get.street_id");
		// 	$data['barbershop_id'] = I("get.barbershop_id");		
		// }
		if(IS_POST){
			$com_id=I('post.company_id');
			$data['com_name']=I('post.com_name');
			$data['user_id']=I('post.user_id');		
			$data['com_logo_big']=I('post.com_logo_big');			
			$data['com_logo_small']=I('post.com_logo_small');	
			$data['province_id'] = I("post.province_id");
			$data['city_id'] = I("post.city_id");
			$data['district_id'] = I("post.district_id");
			$data['street_id'] = I("post.street_id");
			$data['barbershop_id'] = I("post.barbershop_id");
		}
		$res=$this->m->updateCompany($com_id,$data);
		if($res){
			return $this->getinfo(1,'修改成功',$res);
		}else{
			return $this->getinfo(0,'修改失败',$res);
		}
	}



	/**
	*删除广告公司
	*@param $company_id 广告主id
	*@return 
	*/
	public function deleteCompany(){
		if(IS_POST){
			I("post.company_id") ? $data['id']=I("post.company_id"):"";
		}
		$res = $this->m->deleteCompany($data);
		if($res){
			return $this->getinfo(1,"删除成功",$res);
		}else{
			return $this->getinfo(0,"删除失败",$res);
		}
	}






}


 ?>