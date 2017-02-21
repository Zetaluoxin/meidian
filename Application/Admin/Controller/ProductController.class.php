<?php 
namespace Admin\Controller;
use Admin\Controller\CommonController;
	/**
	* 终端控制器
	*版本 1.0
	*作者:罗鑫
	*/
class ProductController extends CommonController{
	protected $m;
	public function __construct(){
		parent::__construct();
		$this->m=D('Product','Logic');
	}
	/**
	* 创建终端
	*@param
	*@return
	*作者:罗鑫
	*/
	public function addProduct($barbershop_id='',$product_type='',$product_maccode='',$product_batch='',$product_status='',$product_fix=''){
		if(IS_GET){
			$data['barbershop_id']=I('get.barbershop_id'); 	//终端所在店铺id
			$data['product_type']=I('get.product_type');		//机型
			$data['product_maccode']=I('get.product_maccode');//mac码	
			$data['product_batch']=I('get.product_batch');	//终端编号
			$data['province_id']=I('get.province_id');
			$data['city_id']=I('get.city_id');
			$data['district_id']=I('get.district_id');
			$data['street_id']=I('get.street_id');
		}
		if(IS_POST){
			$data['barbershop_id']=I('post.barbershop_id');
			$data['product_type']=I('post.product_type');
			$data['product_maccode']=I('post.product_maccode');
			$data['product_batch']=I('post.product_batch');
			$data['province_id']=I('post.province_id');
			$data['city_id']=I('post.city_id');
			$data['district_id']=I('post.district_id');
			$data['street_id']=I('post.street_id');
		}
		// $data=array();
		$res=$this->m->addProduct($data);
		if($res){
			return $this->getinfo(1,'添加成功',$res);
		}else{
			return $this->getinfo(0,'添加失败');
		}
	}






	/**
	* 查询终端
	*@param
	*@return
	*作者:罗鑫
	*/
	public function getProduct($barbershop_id='',$product_type='',$product_maccode='',$product_batch='',$product_status='',$product_fix=''){
		if(IS_GET){
			I('get.barbershop_id')?$data['barbershop_id']=I('get.barbershop_id'):''; 	//终端所在店铺id
			I('get.product_type')?$data['product_type']=I('get.product_type'):'';		//机型
			I('get.product_maccode')?$data['product_maccode']=I('get.product_maccode'):'';//mac码	
			I('get.product_batch')?$data['product_batch']=I('get.product_batch'):'';	//终端编号
			I('get.product_status')?$data['product_status']=I('get.product_status'):'';	//运行状态
			I('get.product_fix')?$data['product_fix']=I('get.product_fix'):'';		//报修状态
			I('get.barbershop_name')?$data['barbershop_name']=I('get.barbershop_name'):'';
		}
		if(IS_POST){
			I('post.barbershop_id')?$data['barbershop_id']=I('post.barbershop_id'):'';
			I('post.product_type')?$data['product_type']=I('post.product_type'):'';
			I('post.product_maccode')?$data['product_maccode']=I('post.product_maccode'):'';
			I('post.product_batch')?$data['product_batch']=I('post.product_batch'):'';
			I('post.product_status')?$data['product_status']=I('post.product_status'):'';
			I('post.product_fix')?$data['product_fix']=I('post.product_fix'):'';
		}
		if($data['barbershop_name']){
			$data['barbershop_id'] = D("Barbershop","Logic")->queryBarbershop(array("barbershop_name"=>$data['barbershop_name']))[0]['id'];
		}
		if($data['product_status']){
			$data['product_status']=='不在线'?$data['product_status'] = '0':'';
			$data['product_status']=='在线'?$data['product_status'] = '1':'';
		}
		if($data['product_fix']){
			$data['product_fix']=='报修'?$data['product_fix'] = '0':'';
			$data['product_fix']=='正常'?$data['product_fix'] = '1':'';
		}
		// var_dump($data);
		// print('我进来拉');
		$res=$this->m->getProduct($data);
		// dump($res);exit();
		if($res){
			// var_dump($res);
			if($data['product_status']){
				foreach ($res as $k => $v) {
					if(!$this->getStatus(array("id"=>$v['id']))){
						unset($res[$k]);
					}
				}
			}
			$this->assign('product',$res);
			return;
		}
		return false;
	}

	/**
	*
	*@param
	*@return 
	*/
	public function getProductById(){
		if(IS_POST){
			$data['id']=I('post.product_id');
		}
		$res = $this->m->getProduct($data);
		if($res){
			return $this->getinfo(1,'查询成功',$res);
		}else{
			return $this->getinfo(0,'查询失败',$res);
		}
	}
	/**
	* 查询终端
	*@param
	*@return
	*作者:罗鑫
	*/
	function getProductNum(){
		if(IS_POST){
			I("post.barbershop_id")?$data['barbershop_id'] = I("post.barbershop_id"):'';
		}
		if(IS_GET){
			I("get.barbershop_id")?$data['barbershop_id'] = I("get.barbershop_id"):'';
		}
		$res = $this->m->getProduct($data);
		$res?$this->getinfo(true,'',$res):$this->getinfo(false,'','');
	}

	/**
	* 判断终端状态信息
	*@param
	*@return
	*作者:杜勇
	*/
	public function getStatus($data=array()){
		if(IS_POST){
			I("post.product_id")?$data['id'] = I("post.product_id"):'';
		}
		if(IS_GET){
			I("get.product_id")?$data['id'] = I("get.product_id"):'';
		}
		$reg = $this->m->getProduct($data)[0];
		$last_time = $reg['last_time'];
		$nowtime = date("Y-m-d H:i:s");
		if(strtotime($nowtime)-strtotime($last_time) > OUT_TIME || $reg['product_status'] == 0){
			$res = $this->m->update_Product($data['id'],'',array("product_status"=>0));
			if(IS_POST){
				$this->getinfo(false,'不在线','');
			}else{
				return 0;
			}
		}else{
			if(IS_POST){
				$this->getinfo(true,"在线",'');
			}else{
				return 1;
			}
		}
	}

	/**
	* 修改终端
	*@param
	*@return
	*作者:杜勇
	*/
	public function updateProduct(){
		if(IS_POST){
			$id = I("post.id");
			$data['barbershop_id']=I('post.barbershop_id');
			$data['product_fix']=I('post.product_fix');
			$data['province_id']=I('post.province_id');
			$data['city_id']=I('post.city_id');
			$data['district_id']=I('post.district_id');
			$data['street_id']=I('post.street_id');
		}
		if(IS_GET){
			$id = I("get.id");
			$data['barbershop_id']=I('get.barbershop_id');
			$data['product_fix']=I('get.product_fix');
			$data['province_id']=I('get.province_id');
			$data['city_id']=I('get.city_id');
			$data['district_id']=I('get.district_id');
			$data['street_id']=I('get.street_id');
		}
		$res = $this->m->update_Product($id,'',$data);
		$res?$this->getinfo(true,'修改成功',$res):$this->getinfo(false,'修改失败',$res);
	}


	/**
	* 删除终端
	*@param
	*@return
	*作者:杜勇
	*/
	public function delProduct(){
		if(IS_POST){
			$id = I("post.id");
		}
		if(IS_GET){
			$id = I("get.id");
		}
		$res = $this->m->del_Product($id);
		$res?$this->getinfo(true,'删除成功',$res):$this->getinfo(false,'删除失败',$res);
	}
	

	/**
	* 查询终端 （省）
	*@param
	*@return
	*作者:
	*/
	public function productProvince($province_id=''){
		if($province_id){
			$data['province_id']=$province_id;
		}
		if(IS_POST){
			$data['province_id']=I('post.product_province'); 
		}
		if(IS_GET){
			$data['province_id']=I('get.product_province'); 
		}
		$res=$this->m->product($data);
		if($res){
			return $this->getinfo(true,'product',$res);
		}
		return $this->getinfo(false,'product',$res);
	}



	/**
	* 查询终端 （市）
	*@param
	*@return
	*作者:
	*/
	public function productCity($city_id=''){
		if($city_id){
			$data['city_id']=$city_id;
			// dump('haha');
		}
		if(IS_POST){
			$data['city_id']=I('post.product_city'); 
		}
		if(IS_GET){
			$data['city_id']=I('get.product_city'); 
		}
		$res=$this->m->product($data);
		if($res){
			return $this->getinfo(true,'product',$res);
		}
		return $this->getinfo(false,'product',$res);
	}



	/**
	* 查询终端 （区）
	*@param
	*@return
	*作者:
	*/
	public function productDistrict(){
		if(IS_POST){
			$data['district_id']=I('post.product_district'); 
		}
		if(IS_GET){
			$data['district_id']=I('get.product_district'); 
		}
		$res=$this->m->product($data);
		if($res){
			return $this->getinfo(true,'product',$res);
		}
		return $this->getinfo(false,'product',$res);
	}



	/**
	* 查询终端 （街道）
	*@param
	*@return
	*作者:
	*/
	public function productStreet(){
		if(IS_POST){
			$data['street_id']=I('post.product_street'); 
		}
		if(IS_GET){
			$data['street_id']=I('get.product_street'); 
		}
		$res=$this->m->product($data);
		if($res){
			return $this->getinfo(true,'product',$res);
		}
		return $this->getinfo(false,'product',$res);
	}



	/**
	* 查询终端 （详细地址）
	*@param
	*@return
	*作者:
	*/
	public function productPlace(){
		if(IS_POST){
			$data['product_place']=I('post.product_place'); 
		}
		if(IS_GET){
			$data['product_place']=I('get.product_place'); 
		}
		$res=$this->m->product($data);
		if($res){
			return $this->assign('product',$res);
		}
		return false;
	}




	/**
	* 省代理查询终端  （省代理查询其所管辖的终端）
	*@param
	*@return
	*作者:
	*/
	public function provinceAgentQueryProduct(){
		$user_id=session('uid');
		$province_id=$this->m->getProvinceId($user_id);
		$data['product_province']=$province_id;
		$res=$this->m->product($data);
		if($res){
			return $this->assign('productlist',$res);
		}
		return false;
	}


	/**
	* 市代理查询终端  （市代理查询其所管辖的终端）
	*@param
	*@return
	*作者:
	*/
	public function cityAgentQueryProduct(){
		$user_id=session('uid');
		$city_id=$this->m->getCityId($user_id);
		$data['product_city']=$city_id;
		$res=$this->m->product($data);
		if($res){
			return $this->assign('productlist',$res);
		}
		return false;
	}

}



 ?>