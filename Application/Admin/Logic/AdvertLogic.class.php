<?php
namespace Admin\Logic;
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
	function select_Advert($data){
		$res = $this->m->where($data)->select();
		return $res;
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

	function examineAdvert($arr,$data){
		return $this->m->where($arr)->save($data);
	}
	function payAdvert($arr,$data){
		return $this->m->where($arr)->save($data);
	}
	function statusAdvert($arr,$data){
		return $this->m->where($arr)->save($data);
	}
}
?>