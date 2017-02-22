<?php
namespace Home\Logic;
use Think\Model\RelationModel;
class AdvertLogic extends RelationModel{
	private $m;
	function __construct(){
		parent::__construct();
		$this->m = M("Advert");
	}
	//广告上传
	function insert_Advert($info,$data){
		$n = $this->m->create($data);
		if($n){
			$res = $this->m->add($data);
			return $res;
		}
		return $n;
	}

	//广告获取
	function select_Advert($data1){
		$DAdvert=D("Advert");

		//查询是否有到理发店的广告 有则返回 没有查询下一级别
		$where1['ad_status']     = "已上架";
		$where1['ad_examine']    = "通过";
		$where1['ad_pay']        = "已付费";
		$where1['barbershop_id'] = $data1['barbershop_id'];
		$res_barbershop = $DAdvert->relation(true)->where($where1)->order("ad_time asc")->limit(3)->select();
		// dump($res_barbershop);die;
		if($res_barbershop){
			return $res_barbershop;
		}

		//查询是否有到街道的广告 有则返回 没有查询下一级
		$where2['ad_status']     = "已上架";
		$where2['ad_examine']    = "通过";
		$where2['ad_pay']        = "已付费";
		$where2['ad_street_id'] = $data1['ad_street_id'];
		$res_street = $DAdvert->relation(true)->where($where2)->order("ad_time asc")->limit(3)->select();
		if($res_street){
			return $res_street;
		}

		//查询是否有到区县的广告 有则返回 没有则查询下一级
		$where3['ad_status']     = "已上架";
		$where3['ad_examine']    = "通过";
		$where3['ad_pay']        = "已付费";
		$where3['ad_district_id'] = $data1['ad_district_id'];
		$res_district = $DAdvert->relation(true)->where($where3)->order("ad_time asc")->limit(3)->select();
		if($res_district){
			return $res_district;
		}

		//查询是否有市级的广告 有则返回  没有则查询下一级
		$where4['ad_status']     = "已上架";
		$where4['ad_examine']    = "通过";
		$where4['ad_pay']        = "已付费";
		$where4['ad_city_id'] = $data1['ad_city_id'];
		$res_city = $DAdvert->relation(true)->where($where4)->order("ad_time asc")->limit(3)->select();
		if($res_city){
			return $res_city;
		}

		//查询是否有到省级的广告 有则返回 没有则查询下一级
		$where5['ad_status']     = "已上架";
		$where5['ad_examine']    = "通过";
		$where5['ad_pay']        = "已付费";
		$where5['ad_province_id'] = $data1['ad_province_id'];
		$res_province = $DAdvert->relation(true)->where($where5)->order("ad_time asc")->limit(3)->select();
		if($res_province){
			return $res_province;
		}
	}

	//广告主信息获取
	function select_Company($data=''){
		if(is_int($data)){
			return M("Company")->where("id='%d'",array($data))->select();
		}else{
			if($data==''){
				return M("Company")->select();
			}
			return M("Company")->where("com_name like'%s'",array("%".$data."%"))->select();
		}
	}

	//广告修改
	function update_Advert($arr,$data){
		$res = $this->m->where("id='%d'",array($arr['id']))->save($data);
		return $res;
	}

	//删除广告
	function del_Advert($data){
		return $this->m->where("id='%d'",array($data['id']))->delete();
	}

	//修改图片广告
	function insert_Ad_Img($arr,$data){
		return $this->m->where("id='%d'",array($arr['ad_id']))->save($data);
	}

	//修改视频广告
	function insert_Ad_Video($arr,$data){
		return $this->m->where("id='%d'",array($arr['ad_id']))->save($data);
	}

	//查询广告详情
	public function queryAdvertInfo($data){
		return $this->m->where($data)->select();
	}

}
?>