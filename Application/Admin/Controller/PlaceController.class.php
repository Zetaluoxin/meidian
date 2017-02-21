<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;
	/**
	* 地区管理控制器
	*AUTH:LUOXIN
	*2016.12.19
	*详细注释在316行开始噢~~~~~~~~~~~~~~~~
	*/



class PlaceController extends CommonController{
	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=D('Place','Logic');
	}



	/**
	*查询/添加 省
	*@param
	*@return
	*/
	public function province(){
		if(IS_POST){
			$data['province_name']=I('post.province_name');
			$data['province_id']=I('post.province_id');
		}
		// if(IS_GET){
		// 	$data['province_name']=I('get.province_name');			
		// 	$data['province_id']=I('get.province_id');			
		// }
		if($data['province_id'] == 0){unset($data['province_id']);}
		// $data['province_name']='湖南';
		$res=$this->m->province($data);
		// dump($res);die;
		if($res['type']=='create'){
			if($res['res']){
				return $this->getinfo(1,'添加成功',$res['res']);
			}else{
				return $this->getinfo(0,'添加失败',$res['res']);
			}
		}else if($res['type']=='select'){
			if($res['res']){
				return $this->assign('province',$res['res']);
			}else{
				return false;
			}
		}else{
			// dump('false');
			return false;
		}
	}






	/**
	*修改 省
	*@param
	*@return
	*/
	public function updateProvince(){
		if(IS_POST){
			$province_id=I('post.province_id');
			$data['province_name']=I('post.province_name');
		}
		// if(IS_GET){
		// 	$province_id=I('get.province_id');			
		// 	$data['province_name']=I('get.province_name');			
		// }
		$res=$this->m->updateProvince($province_id,$data);
		if($res){
			return $this->getinfo(1,'修改成功',$res);
		}else{
			return $this->getinfo(0,'修改失败',$res);
		}
	}





	/**
	*通过省份的id查询其下所有的市/区
	*@param $province_id
	*@return
	*/
	public function city(){
		if(IS_POST){
			$data['province_id']=I('post.province_id');
			$data['city_name']=I('post.city_name');
		}
		// if(IS_GET){
		// 	$data['province_id']=I('get.province_id');
		// 	$data['city_name']=I('get.city_name');
		// }
		// $data['province_id']=1;
		// $data['city_name']='fsdf';
		$res=$this->m->city($data);
		if($res['type']=='create'){
			if($res['res']){
				return $this->getinfo(1,'添加成功',$res['res']);
			}else{
				return $this->getinfo(0,'添加失败',$res['res']);
			}
		}else if($res['type']=='select'){
			if($res['res']){
				return $this->getinfo(true,'',$res['res']);
			}else{
				return $this->getinfo(false,'',$res['res']);
			}
		}else{
			// dump('false');
			return false;
		}
	}





	/**
	*修改市信息
	*@param
	*@return
	*/
	public function updateCity(){
		if(IS_POST){
			$city_id=I('post.city_id');
			$data['province_id']=I('post.province_id');
			$data['city_name']=I('post.city_name');
		}
		// if(IS_GET){
		// 	$city_id=I('get.city_id');
		// 	$data['province_id']=I('get.province_id');
		// 	$data['city_name']=I('get.city_name');
		// }
		$res=$this->m->updateCity($city_id,$data);
		if($res){
			return $this->getinfo(1,'修改成功',$res);
		}else{
			return $this->getinfo(0,'修改失败',$res);			
		}
	}



	/**
	*创建市
	*/
	public function addCity(){
		if(IS_POST){
			$data['province_id']=I('post.province_id');
			$data['city_name']=I('post.city_name');
		}
		// dump($data);die;
		$res=$this->m->addProvince($data);
		if($res){
			return $this->getinfo(1,'添加成功',$res);
		}
		return $this->getinfo(0,'添加失败',$res);
	}




	/**
	*通过市/区的id查询其下所有的区/县
	*@param $city_id
	*@return
	*/
	public function district(){
		if(IS_POST){
			$data['city_id']=I('post.city_id');
			$data['district_name']=I('post.district_name');
		}
		// if(IS_GET){
		// 	$data['city_id']=I('get.city_id');
		// 	$data['district_name']=I('get.district_name');
		// }
		// $data['city_id']=1;
		// $data['district_name']='和平区';	
		$res=$this->m->district($data);
		if($res['type']=='create'){
			if($res['res']){
				return $this->getinfo(1,'添加成功',$res['res']);
			}else{
				return $this->getinfo(0,'添加失败',$res['res']);
			}
		}else if($res['type']=='select'){
			if($res['res']){
				return $this->getinfo(true,'',$res['res']);
			}else{
				return $this->getinfo(false,'',$res['res']);
			}
		}else{
			// dump('false');
			return false;
		}
	}

	/**
	*创建区/县
	*@param 
	*@return
	*/
	public function addDistrict(){
		if(IS_POST){
			$data['city_id']=I('post.city_id');
			$data['district_name']=I('post.district_name');
		}
		$res=$this->m->addDistrict($data);
		if($res){
			return $this->getinfo(1,'添加成功',$res);
		}
		return $this->getinfo(0,'添加失败',$res);
	}




	/**
	*修改区/县
	*@param 
	*@return
	*/
	public function updateDistrict(){
		if(IS_POST){
			$district_id=I('get.district_id');
			$data['city_id']=I('post.city_id');
			$data['district_name']=I('post.district_name');
		}
		// if(IS_GET){
		// 	$district_id=I('post.district_id');
		// 	$data['city_id']=I('get.city_id');
		// 	$data['district_name']=I('get.district_name');
		// }
		$res=$this->m->updateDistrict($district_id,$data);
		if($res){
			return $this->getinfo(1,'修改成功',$res);
		}else{
			return $this->getinfo(0,'修改失败',$res);			
		}

	}











	/**
	*通过区/县的id查询其下所有的街道/村
	*@param $district_id
	*@return
	*/
	public function street(){
		if(IS_POST){
			$data['district_id']=I('post.district_id');
			$data['street_name']=I('post.street_name');
		}
		// if(IS_GET){
		// 	$data['district_id']=I('get.district_id');
		// 	$data['street_name']=I('get.street_name');
		// }
		// $data['district_id']=2;
		// $data['street_name']='天地仁和';
		$res=$this->m->street($data);
		if($res['type']=='create'){
			if($res['res']){
				return $this->getinfo(1,'添加成功',$res['res']);
			}else{
				return $this->getinfo(0,'添加失败',$res['res']);
			}
		}else if($res['type']=='select'){
			if($res['res']){
				return $this->getinfo(true,'',$res['res']);
			}else{
				return $this->getinfo(false,'',$res['res']);
			}
		}else{
			// dump('false');
			return false;
		}
	}





	/**
	*修改街道/村
	*@param 
	*@return
	*/
	public function addStreet(){
		if(IS_POST){
			$data['district_id']=I('post.district_id');
			$data['street_name']=I('post.street_name');
		}
		// dump($data);die;
		$res=$this->m->addStreet($data);
		if($res){
			return $this->getinfo(1,'添加成功',$res);
		}
		return $this->getinfo(0,'添加失败',$res);
	}


	/**
	*修改街道/村
	*@param 
	*@return
	*/
	public function updateStreet(){
		if(IS_POST){
			$street_id=I('post.street_id');
			$data['district_id']=I('post.district_id');
			$data['street_name']=I('post.street_name');
		}
		// if(IS_GET){
		// 	$street_id=I('get.street_id');
		// 	$data['district_id']=I('get.district_id');
		// 	$data['street_name']=I('get.street_name');
		// }
		$res=$this->m->updateStreet($street_id,$data);
		if($res){
			return $this->getinfo(1,'修改成功',$res);
		}else{
			return $this->getinfo(0,'修改失败',$res);			
		}
	}




	/**
	*1.查询地区 所有
	*2.查询地区 通过街道id($street_id)
	*3.创建地区 并且强制关联 街道id($street_id) 否则无法创建
	*@param $street_id 通过街道  $place_name 地区名称
	*@return 返回太多了，自己看吧
	*/
		public function place(){
		if(IS_POST){
			$data['street_id']=I('post.street_id');
			$data['place_name']=I('post.place_name');
		}
		// if(IS_GET){
		// 	$data['street_id']=I('get.street_id');
		// 	$data['place_name']=I('get.place_name');
		// }
		// $data['street_id']=1;
		// $data['place_name']='fsdafds';
		$res=$this->m->place($data);
		// dump($res);die;
		//判断返回结果中type中是否是进行了创建操作
		if($res['type']=='create'){
			//如果创建成功
			if($res['res']){
				//返回创建成功的信息
				return $this->getinfo(1,'添加成功',$res['res']);
			}else{
				return $this->getinfo(0,'添加失败',$res['res']);
			}
			//判断返回结果中的type是否进行了查询操作
		}else if($res['type']=='select'){
			//如果成功进行了查询操作
			if($res['res']){
				//进行帮点变量操作
				return $this->assign('place',$res);
			}else{
				return false;
			}
		}else{
			// dump('false');
			return false;
		}
	}


	



	/**
	*修改街具体位置
	*@param 
	*@return
	*/
	public function updatePlace(){
		if(IS_POST){
			$street_id=I('post.street_id');
			$data['district_id']=I('post.district_id');
			$data['street_name']=I('post.street_name');
		}
		// if(IS_GET){
		// 	$street_id=I('get.street_id');
		// 	$data['district_id']=I('get.district_id');
		// 	$data['street_name']=I('get.street_name');
		// }
		$res=$this->m->updatePlace($street_id,$data);
		if($res){
			return $this->getinfo(1,'修改成功',$res);
		}else{
			return $this->getinfo(0,'修改失败',$res);			
		}
	}






	/**
	*通过id获得省份
	*@param 
	*@return
	*/
	public function queryProvinceById(){
		if(IS_POST){
			$province_id['id']=I('post.province_id');
		}
		// if(IS_GET){
		// 	$province_id=I('get.province_id');
		// }
		$res=$this->m->queryProvinceById($province_id);
		if($res){
			return $this->assign('province',$res);
		}
		return false;
	}





	/**
	*通过id获得市
	*@param 
	*@return
	*/
	public function queryCityById(){
		if(IS_POST){
			$city_id=I('post.city_id');
		}
		// if(IS_GET){
		// 	$city_id=I('get.city_id');
		// }
		$res=$this->m->queryCityById($city_id);
		if($res){
			return $this->assign('city',$res);
		}
		return false;
	}





	/**
	*通过id获得区/县
	*@param 
	*@return
	*/
	public function queryDistrictById(){
		if(IS_POST){
			$district_id=I('post.district_id');
		}
		// if(IS_GET){
		// 	$district_id=I('get.district_id');
		// }
		$res=$this->m->queryDistrictById($district_id);
		if($res){
			return $this->assign('district',$res);
		}
		return false;
	}





	/**
	*通过id获得街道/村
	*@param 
	*@return
	*/
	public function queryStreetById(){
		if(IS_POST){
			$street_id=I('post.street_id');
		}
		if(IS_GET){
			$street_id=I('get.street_id');
		}
		$res=$this->m->queryStreetById($street_id);
		if($res){
			return $this->assign('street',$res);
		}
		return false;
	}





	/**
	*通过id获得具体位置
	*@param 
	*@return
	*/
	public function queryPlaceById(){
		if(IS_POST){
			$place_id=I('post.place_id');
		}
		if(IS_GET){
			$place_id=I('get.place_id');
		}
		$res=$this->m->queryPlaceById($place_id);
		if($res){
			return $this->assign('city',$res);
		}
		return false;
	}




}

				






				

 ?>