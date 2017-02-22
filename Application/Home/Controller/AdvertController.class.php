<?php
namespace Home\Controller;
use Home\Controller\CommonController;
use GatewayClient\Gateway;
	/**
	* 广告控制器
	*版本 1.0
	*作者:杜勇
	*
	*update:
	*time 2017/2/14
	*content:
	*广告推送
	*/
class AdvertController extends CommonController{
	private $m;
	function __construct(){
		parent::__construct();
		$this->m = D("Advert","Logic");
	}
	function index(){
		dump($_SERVER);
	}
	

	/**
	* 获取广告
	*@param $mac
	*@return 成功返回查询结果集的二维数组，失败返回false;
	* 
	*/
	function getAdvert(){
		if(IS_POST){
			$data['product_maccode'] = I("post.mac");
		}
		if(IS_GET){
			$data['product_maccode'] = I("get.mac");
		}
		$data['product_maccode'] = 'cc:79:cf:6b:a0:2e';
		// $data['product_maccode'] = '545746868678';
		// dump($data);die;
		//获得终端的详情 地理位置
		$p = D("Product","Logic");
		$res=$p->getProduct($data);
		//组装参数
		$data1['ad_province_id'] 	= $res[0]['province_id'];   //所在省份id
		$data1['ad_city_id']     	= $res[0]['city_id'];           //所在市id
		$data1['ad_district_id'] 	= $res[0]['district_id'];   //所在区/县id
		$data1['ad_street_id']   	= $res[0]['street_id'];       //所在街道id
		$data1['barbershop_id'] = $res[0]['barbershop_id'];
		$res1 = $this->m->select_Advert($data1);
		if($res1){
			return $this->getinfo(1,'success',$res1);
		}else{
			return $this->getinfo(0,'falid',$res1);
		}
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

	//广告推送
	//服务端广告推送
	public function pushAdvert(){
			// dump('haha');
			//获取推送广告id 组装参数
			if(IS_POST){
				I('post.advert_id') ? $data['id'] = I('post.advert_id') : '';
			}
			if(!$data['id']){
				return $this->getinfo(0,'不存在的广告');
			}
			// $data['id'] = 1 ;
			//查询广告推送的地区
			$res = $this->m->queryAdvertInfo($data);
			// dump($res);die;
			//组装参数
			if($res){
				$province_id 	= $res[0]['ad_province_id'];
				$city_id 	 	= $res[0]['city_id'];
				$district_id 	= $res[0]['district_id'];
				$street_id 	 	= $res[0]['street_id'];
				$barbershop_id  = $res[0]['barbershop_id'];
				$img_id	        = $res[0]['img_id'];
				$video_id		= $res[0]['video_id'];
			}else{
				return $this->getinfo(0,'广告格式错误');
			}



			$file = D("File","Logic");
			if($img_id != 0 && $video_id == 0 ){
				  $img_url = $file->getImgById($img_id)[0]['big_img'];
				  $res[0]['img_url']=$img_url;
				  $message = array(
				  	'type'=> 'img_advert',
				  	'message'=>$res
				  	);
			}else if($img_id == 0 && $video_id != 0){
				$video_url = $file->getVideoById($video_id)[0]['video_url'];
				$res[0]['video_url']=$video_url;
				$message = array(
				  	'type'=> 'video_advert',
				  	'message'=>$res
				  	);
			}else{
				return $this->getinfo(0,'广告格式错误');
			}		
			// dump($message);die;



			$product = D("Product","Logic");
			//如果广告推送的最下级为理发店，理发店的id不会为0
			if($barbershop_id != 0 ){
				//查询所属广告最下级的终端mac
				$res_barbershop = $product->getProductByBabershop($barbershop_id);
				//将获得的mac放入一个数组中
				$uid_barbershop = array();
				for($i=0 ; $i<count($res_barbershop) ; $i++){
					array_push($uid_barbershop,$res_barbershop[$i]['product_maccode'] );
				}
				//循环推送广告到指定的mac终端
				for($j = 0 ; $j < count($uid_barbershop); $j++){
					//推送广告
					Gateway::sendToUid($uid_barbershop[$j], json_encode($message));
				}
				return $this->getinfo(1,'推送成功');
			}
			//如果广告推送的最下级为街道，街道的id不会为0
			if($street_id != 0){
				$res_street = $product->getProductByStreet($street_id);
				$uid_street = array();
				for($a=0 ; $a<count($res_street) ; $a++){
					array_push($uid_street,$res_street[$a]['product_maccode']);
				}
				for($b = 0 ; $b < count($uid_street) ; $b++){				
					Gateway::sendToUid($uid_street[$b],json_encode($message));
				}
				return $this->getinfo(1,'推送成功');
			}
			//如果广告推送的最下级为区县，区县的id不会为0
			if($district_id != 0 ){
				$res_district = $product->getProductByDistrict($district_id);
				$uid_district = array();
				for($c = 0 ; $c < count($res_district) ; $c++){
					array_push($uid_district, $res_district[$c]['product_maccode']);
				}
				for($d = 0 ; $d < count($uid_district) ; $d++){
					Gateway::sendToUid($uid_district[$d],json_encode($message));
				}
				return $this->getinfo(1,'推送成功');
			}
			//如果广告推送的最下级为市，市的id不会为0
			if($city_id != 0 ){
				$res_city = $product->getProductByCity($city_id);
				$uid_city = array();
				for($e = 0 ; $e < count($res_city); $e++){
					array_push($uid_city, $res_city[$e]['product_maccode']);
				}
				for($f = 0 ; count($uid_city) ; $f++){
					Gateway::sendToUid($uid_city[$f],json_encode($message));
				}
				return $this->getinfo(1,'推送成功');
			}
			//如果广告推送的最下级为省，省的id不会为0
			if($province_id != 0){
				$res_province = $product->getProductByProvince($province_id);
				$uid_province = array();
				for($g = 0 ; $g < count($res_province);$g++){
					array_push($uid_province, $res_province[$g]['product_maccode']);
				}
				for($h = 0 ; $h < count($uid_province); $h++){
					Gateway::sendToUid($uid_province[$h],json_encode($message));
				}
				return $this->getinfo(1,'推送成功');
			}
		}
	
}
?>