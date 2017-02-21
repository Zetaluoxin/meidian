<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;
class BarbershopController extends CommonController{
	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=D('Barbershop','Logic');
	}

	/**
	*添加理发店
	*@param
	*@return
	*/
	public function addBarbershop($babershop_name='',$barbershop_address='',$barbershop_cash='',$babershop_qrcode=''){
		// if(IS_GET){
		// 	$data['user_id'] = I("get.user_id");
		// 	$data['barbershop_name']=I('get.barbershop_name');
		// 	$data['barbershop_province']=I('get.barbershop_province');
		// 	$data['barbershop_city']=I('get.barbershop_city');
		// 	$data['barbershop_district']=I('get.barbershop_district');
		// 	$data['barbershop_street']=I('get.barbershop_street');
		// 	// $data['$barbershop_cash']=I('get.barbershop_cash');
		// 	// $data['$babershop_qrcode']=I('get.babershop_qrcode');

		// }
		if(IS_POST){
			$data['user_id'] = I("post.user_id");
			$data['barbershop_name']=I('post.barbershop_name');
			$data['barbershop_province']=I('post.barbershop_province');
			$data['barbershop_city']=I('post.barbershop_city');
			$data['barbershop_district']=I('post.barbershop_district');
			$data['barbershop_street']=I('post.barbershop_street');
			// $data['$barbershop_cash']=I('post.barbershop_cash');
			// $data['$babershop_qrcode']=I('post.babershop_qrcode');
		}
		// $data['barbershop_name']='lxlxlxlx';
		$res=$this->m->addBarbershop($data);
		// dump($res);exit;
		if($res){
			return $this->getinfo(1,'添加成功',$res);
		}else{
			return $this->getinfo(0,'添加失败');
		}
	}






	/**
	*查询理发店 通过理发店id
	*@param
	*@return
	*/
	public function queryBarbershop($user_id=''){
		if(IS_GET){
			I("get.names")?$data['names']=I('get.names'):'';
			I("get.shop_name")?$data['barbershop_name']=I('get.shop_name'):'';
			I("get.place")?$data['place']=I('get.place'):'';
		}
		if(IS_POST){
			I('post.user_id')?$data['user_id']=I('post.user_id'):'';
		}
		if($data['names']){
			$data['user_id'] = D("User","Logic")->select_User(array("names"=>$data['names']))[0]['id'];
		}
		if($data['place']){
			$data['barbershop_province'] = D("Place",'Logic')->queryProvinceById(array("province_name"=>$data['place']))[0]['id'];
		}
		$res=$this->m->queryBarbershop($data);
		if($res){
			$this->assign('barbershop',$res);
			return;
		}
		return false;
	}






	/**
	*修改理发店信息 通过理发店id
	*@param
	*@return
	*/
	public function updateBarbershop(){
		// if(IS_GET){
		// 	$barbershop_id=I('get.id');
		// 	$data['barbershop_name']=I('get.barbershop_name');
		// 	$data['barbershop_cash']=I('get.barbershop_cash');
		// 	$data['user_id']=I('get.user_id');
		// 	$data['babershop_qrcode']=I('get.babershop_qrcode');
		// 	$data['barbershop_province']=I('get.barbershop_province');
		// 	$data['barbershop_city']=I('get.barbershop_city');
		// 	$data['barbershop_district']=I('get.barbershop_district');
		// 	$data['barbershop_street']=I('get.barbershop_street');
		// }
		if(IS_POST){
			$barbershop_id=I('post.id');
			$data['barbershop_name']=I('post.barbershop_name');
			$data['barbershop_cash']=I('post.barbershop_cash');
			$data['user_id']=I('post.user_id');
			$data['babershop_qrcode']=I('post.babershop_qrcode');
			$data['barbershop_province']=I('post.barbershop_province');
			$data['barbershop_city']=I('post.barbershop_city');
			$data['barbershop_district']=I('post.barbershop_district');
			$data['barbershop_street']=I('post.barbershop_street');
		}
		$res=$this->m->updateBarbershop($barbershop_id,$data);
		if($res){
			return $this->getinfo(1,'修改成功',$res);
		}else{
			return $this->getinfo(0,'修改分失败',$res);			
		}
	}





	/**
	*理发店数量统计  地区（省）
	*@param
	*@return
	*/	
	public function babershopStatisticsByProvince(){
		if(IS_GET){
			$data['barbershop_province']=I('get.barbershop_province');

		}
		if(IS_POST){
			$data['barbershop_province']=I('post.barbershop_province');
		}
		$res=$this->m->babershopStatistics($data);
		if($res){
			return $this->assign('statisticsByProvince',$res);
		}
		return false;
	}






	/**
	*理发店数量统计  地区（市）
	*@param
	*@return
	*/	
	public function babershopStatisticsByCity(){
		if(IS_GET){
			$data['barbershop_city']=I('get.barbershop_city');
		}
		if(IS_POST){
			$data['barbershop_city']=I('post.barbershop_city');
		}
		$res=$this->m->babershopStatistics($data);
		if($res){
			return $this->assign('statisticsByCity',$res);
		}
		return false;
	}





	/**
	*理发店数量统计  地区（区）
	*@param
	*@return
	*/	
	public function babershopStatisticsByDistrict(){
		if(IS_GET){
			$data['barbershop_district']=I('get.barbershop_district');
		}
		if(IS_POST){
			$data['barbershop_district']=I('post.barbershop_district');
		}
		$res=$this->m->babershopStatistics($data);
		if($res){
			return $this->assign('statisticsByDistrict',$res);
		}
		return false;
	}





	/**
	*理发店数量统计  地区（街道）
	*@param
	*@return
	*/	
	public function babershopStatisticsByStreet(){
		if(IS_GET){
			$data['babershop_street']=I('get.babershop_street');
		}
		if(IS_POST){
			$data['babershop_street']=I('post.babershop_street');
		}
		$res=$this->m->babershopStatistics($data);
		if($res){
			return $this->assign('statisticsByStreet',$res);
		}
		return false;
	}




	/**
	*通过街道查询理发店
	*@param
	*@return
	*/
	public function queryBarbershopByStreet(){
		if(IS_GET){
			$data['barbershop_street']=I('get.barbershop_street');
		}
		if(IS_POST){
			$data['barbershop_street']=I('post.barbershop_street');
		}
		$res=$this->m->queryBarbershopByStreet($data);
		if($res){
			return $this->getinfo(true,'',$res);
		}
		return $this->getinfo(false,'',$res);
	}
}


 ?>