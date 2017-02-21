<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
	/**
	* 广告控制器
	*版本 1.0
	*作者:杜勇
	*/
class AdvertController extends CommonController{
	private $m;
	function __construct(){
		parent::__construct();
		$this->m = D("Advert","Logic");
	}
	function index(){
		print_r($_SERVER);
	}
	/**
	* 插入广告信息
	*@param $infos为上传返回地址，类型为数组，大图和缩略图和视频
	*@return 成功上传返回数据库插入id和广告地区中间表插入id的数组，失败则返回false;
	* 
	*/
	function addAdvert(){
		if(!empty($_FILES)){
			$infos = $this->upload();
		}
		if(IS_POST){
			$data['img_id'] = I('post.img_id');
			$data['video_id'] = I('post.video_id');
			$data['user_id'] = session("uid");
			$data['ad_name'] = I("post.ad_name");
			$data['ad_text'] = trim(I("post.ad_text"));
			$data['ad_company_id'] = I("post.ad_company");
			$data['ad_area_id'] = I("post.ad_area_id");
			$data['ad_province_id'] = I("post.ad_province_id");
			$data['ad_city_id'] = I("post.ad_city_id");
			$data['ad_street_id'] = I("post.ad_street_id");
			$data['barbershop_id'] = I("post.barbershop_id");
			$data['ad_district_id'] = I("post.ad_district_id");
			$data['ad_putnum'] = I("post.ad_putnum");
			$data['ad_time'] = date("Y-m-d H:i:s");
			if(empty(I("post."))){
				$this->getinfo(false,'参数不能为空','');
			}
		}
		$fl = D("File","Logic");
		$this->m->startTrans();
		try{
			//提交参数为图片id且图片已经修改时执行
			if($data['img_id'] && !$data['video_id']){
				//查询所有使用数据库中素材的广告
				$ad_img = $this->m->select_Advert(array("img_id"=>$data['img_id']));
				//素材只被当前修改的广告使用时才修改状态为未上线
				if(count($ad_img) == 1){
					$ret = $fl->update_Img($data['img_id'],array("status"=>"未上线"));
					if(!$ret){
						$this->getinfo(false,'图片修改失败',$ret);
					}
				}
				$reg = $fl->update_Img($data['img_id'],array("status"=>'已上线'));
			//视频原理同图片
			}else if($data['video_id'] && !$data['img_id']){
				$ad_video = $this->m->select_Advert(array("video_id"=>$data['video_id']));
				if(count($ad_video) == 1){
					$ret = $fl->update_Video($data['video_id'],array("status"=>'未上线'));
					if(!$ret){
						$this->getinfo(false,'视频修改失败',$ret);
					}
				}
				$reg = $fl->update_Video($data['video_id'],array("status"=>'已上线'));
			}
		}catch(Exception $e){
			$this->m->rollback();
		}
		$this->m->commit();
		$res = $this->m->insert_Advert($infos,$data);
		$res?$this->getinfo(true,'新增成功',$res):$this->getinfo(false,'新增失败',$res);
	}

	/**
	* 获取广告
	*@param $data为提交参数
	*@return 成功返回查询结果集的二维数组，失败返回false;
	* 
	*/
	function getAdvert(){
		if(IS_POST){
			$data = I("post.");
		}
		if(IS_GET){
			$data = I("get.");
		}
		// var_dump($data);
		//设置广告名称的模糊查询
		if(array_key_exists('ad_name', $data)){
			$name = $data['ad_name'];
			$data['ad_name'] = array('like',"%".$name."%");
		}
		if($data['format'] == '图片'){
			$data['img_id'] = array('neq',0);
		}else if($data['format'] == '视频'){
			$data['video_id'] = array('neq',0);
		}
		if($data['area']){
			$data['ad_area_id'] = D("Area","Logic")->queryarea(array('area'=>$data['area']))[0]['id'];
		}
		// var_dump($data);
		$res = $this->m->select_Advert($data);
		// print_r($res);
		if($res){
			$this->assign("advert",$res);
			return;
		}
		return false;
	}

	/**
	* 获取广告主
	*@param $data为提交参数
	*@return 成功返回查询结果集的二维数组，失败返回false;
	* 
	*/
	function getCompany(){
		if(IS_POST){
			$data = I("post.company");
		}
		if(IS_GET){
			$data = I("get.company");
		}
		$res = $this->m->select_Company($data);
		if($res){
			$this->assign("company",$res);
			return;
		}
		return false;
	}

	/**
	* 修改广告
	*@param  $data $arr为提交参数
	*@return 失败返回false;
	* 
	*/
	public function updateAdvert(){
		$arr  = array();
		$data = array(); 
		if(IS_POST){
			I("post.id")             ? $arr['id']              = I("post.id") 				: "";
			I("post.ad_name")        ? $data['ad_name']        = I("post.ad_name") 			: "";
			I("post.ad_company_id")  ? $data['ad_company_id']  = I("post.ad_company_id") 	: "";
			I("post.ad_area_id")     ? $data['ad_area_id']     = I("post.ad_area_id") 		: "";
			I("post.ad_province_id") ? $data['ad_province_id'] = I("post.ad_province_id") 	: "";
			I("post.ad_city_id")     ? $data['ad_city_id']     = I("post.ad_city_id") 		: "";
			I("post.ad_district_id") ? $data['ad_district_id'] = I("post.ad_district_id") 	: "";
			I("post.ad_city_id")     ? $data['ad_city_id']     = I("post.ad_city_id") 		: "";
			I("post.ad_street_id")   ? $data['ad_street_id']   = I("post.ad_street_id") 	: "";
			I("post.barbershop_id")  ? $data['barbershop_id']  = I("post.barbershop_id") 	: "";
			I("post.img_id")         ? $data['img_id']         = I("post.img_id") 			: "";
			I("post.video_id")       ? $data['video_id']       = I("post.video_id") 		: "";
			I("post.ad_text")        ? $data['ad_text']        = I("post.ad_text") 			: "";
			I("post.ad_putnum")      ? $data['ad_putnum']      = I("post.ad_putnum") 		: "";
		}
		$res = $this->m->update_Advert($arr,$data);
		if($res){
			return $this->getinfo(1,'success',$res);
		}
		return $this->getinfo(0,'faild',$res);
	}




	/**
	* 审核广告
	*@param $data为提交参数
	*@return 成功返回查询结果集的二维数组，失败返回false;
	* 
	*/
	public function examineAdvert(){
		if(IS_POST){
			I("post.id") ? $arr['id'] = I("post.id") : "";
			I("post.ad_examine") ? $data['ad_examine'] = I("post.ad_examine") : "";
		}
		// dump();die;
		$res = $this->m->examineAdvert($arr,$data);
		if($res){
			return $this->getinfo(1,"success",$res);
		}else{
			return $this->getinfo(0,'faild',$res);
		}
	}


	/**
	* 广告付费状态
	*@param $data为提交参数
	*@return 成功返回查询结果集的二维数组，失败返回false;
	* 
	*/	
	public function payAdvert(){
		if(IS_POST){
			I("post.id") ? $arr['id'] = I("post.id") : "";
			I("post.ad_pay") ? $data['ad_pay'] = I("post.ad_pay") : "";
		}
		$res = $this->m->payAdvert($arr,$data);
		if($res){
			return $this->getinfo(1,"success",$res);
		}else{
			return $this->getinfo(0,'faild',$res);
		}
	}

	/**
	* 广告上下架
	*@param $data为提交参数
	*@return 成功返回查询结果集的二维数组，失败返回false;
	* 
	*/	
	public function statusAdvert(){
		if(IS_POST){
			I("post.id") ? $arr['id'] = I("post.id") : "";
			I("post.ad_status") ? $data['ad_status'] = I("post.ad_status") : "";
		}
		$res = $this->m->statusAdvert($arr,$data);
		if($res){
			return $this->getinfo(1,"success",$res);
		}else{
			return $this->getinfo(0,'faild',$res);
		}
	}

	/**
	* 删除广告
	*@param $data为广告id
	*@return 成功返回删除数目，失败返回false;
	* 
	*/
	function delAdvert(){
		IS_POST?$data['id'] = I("post.id"):"";
		$res = $this->m->del_Advert($data);
		$res?$this->getinfo(true,'删除成功',$res):$this->getinfo(false,'删除失败',$res);
	}

	/**
	* 修改广告
	*@param $data为提交参数
	*@return 成功返回查询结果集的二维数组，失败返回false;
	* 
	*/
	// function addAdFile(){
	// 	if(IS_POST){
	// 		$arr['ad_id'] = I("post.ad_id");
	// 		$data['img_id'] = (int)I("post.img_id");
	// 		$data['video_id'] = (int)I("post.video_id");
	// 	}
	// 	// if(IS_GET){
	// 	// 	$arr['ad_id'] = I("get.ad_id");
	// 	// 	$data['img_id'] = I("get.img_id");
	// 	// 	$data['video_id'] = I("get.video_id");
	// 	// }
	// 	if($data['img_id'] && $data['video_id']){
	// 		$this->getinfo(false,'只能添加一个素材');
	// 	}
	// 	if($data['img_id'] && !$data['video_id']){
	// 		unset($data['video_id']);
	// 		// var_dump($data);
	// 		$res = $this->m->insert_Ad_Img($arr,$data);
	// 	}
	// 	if($data['video_id'] && !$data['img_id']){
	// 		unset($data['img_id']);
	// 		$res = $this->m->insert_Ad_Video($arr,$data);
	// 	}
	// 	$res?$this->getinfo(true,'修改成功',$res):$this->getinfo(false,'修改失败',$res);
	// }
}
?>